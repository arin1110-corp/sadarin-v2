<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\SadarinOtp;
use App\Models\SadarinUserRole;
use Illuminate\Http\Client\ConnectionException;
use App\Services\SadarinAccessLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SadarinLoginController extends Controller
{
    public function index()
    {
        return view('LoginPage.index');
    }
    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validator = Validator::make(
            $request->all(),
            [
                'nip' => ['required', 'string', 'max:100'],

                'password' => ['required', 'string', 'max:255'],
            ],
            [
                'nip.required' => 'NIP atau NIK wajib diisi.',
                'password.required' => 'Password wajib diisi.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->only('nip'));
        }

        $identifier = trim($request->nip);

        /*
        |--------------------------------------------------------------------------
        | API SAMPERIN
        |--------------------------------------------------------------------------
        */

        $apiUrl = rtrim(config('services.samperin.url'), '/') . '/login';

        try {
            $response = Http::acceptJson()
                ->asJson()
                ->timeout(15)
                ->post($apiUrl, [
                    'nip' => $identifier,
                    'password' => $request->password,
                ]);
        } catch (ConnectionException $e) {
            Log::error('SADARIN gagal terhubung ke API SAMPERIN.', [
                'url' => $apiUrl,
                'error' => $e->getMessage(),
            ]);

            return back()->withInput($request->only('nip'))->with('error', 'Server SAMPERIN tidak dapat dihubungi. Silakan coba lagi.');
        } catch (\Throwable $e) {
            Log::error('SADARIN error saat login SAMPERIN.', [
                'url' => $apiUrl,
                'error' => $e->getMessage(),
            ]);

            return back()->withInput($request->only('nip'))->with('error', 'Terjadi kesalahan saat memproses login.');
        }

        /*
        |--------------------------------------------------------------------------
        | CEK RESPONSE
        |--------------------------------------------------------------------------
        */

        if (!$response->successful()) {
            SadarinAccessLogService::log(action: 'login.failed', userType: 'user');

            return back()->withInput($request->only('nip'))->with('error', 'NIP/NIK atau password salah.');
        }

        $result = $response->json();

        if (!isset($result['status']) || $result['status'] !== true || !isset($result['data'])) {
            return back()->withInput($request->only('nip'))->with('error', 'Data login dari SAMPERIN tidak valid.');
        }

        $pegawai = $result['data'];

        /*
        |--------------------------------------------------------------------------
        | DATA PEGAWAI
        |--------------------------------------------------------------------------
        */

        $samperinUserId = $pegawai['id'] ?? null;

        $nama = $pegawai['nama'] ?? null;

        $nip = $pegawai['nip'] ?? null;

        $email = $pegawai['email'] ?? null;

        if (!$samperinUserId) {
            Log::warning('Login SAMPERIN berhasil tetapi ID pegawai tidak ditemukan.', [
                'identifier' => $identifier,
            ]);

            return back()->withInput($request->only('nip'))->with('error', 'Data pegawai tidak lengkap. Silakan hubungi administrator.');
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA ROLE SADARIN
        |--------------------------------------------------------------------------
        */

        $roleData = SadarinUserRole::query()

            ->join('sadarin_role', 'sadarin_user_role.user_role_role_id', '=', 'sadarin_role.role_id')

            ->where('sadarin_user_role.user_role_samperin_user_id', $samperinUserId)

            ->where('sadarin_role.role_is_active', true)

            ->select('sadarin_role.role_id', 'sadarin_role.role_name', 'sadarin_role.role_description')

            ->orderBy('sadarin_role.role_id')

            ->get();

        /*
        |--------------------------------------------------------------------------
        | TIDAK PUNYA ROLE
        |--------------------------------------------------------------------------
        */

        if ($roleData->isEmpty()) {
            Log::warning('Pegawai belum memiliki role SADARIN.', [
                'samperin_user_id' => $samperinUserId,
                'nip' => $nip,
            ]);

            return back()->withInput($request->only('nip'))->with('error', 'Akun Anda belum memiliki hak akses SADARIN. Silakan hubungi administrator.');
        }

        /*
        |--------------------------------------------------------------------------
        | EMAIL
        |--------------------------------------------------------------------------
        */

        if (!$email) {
            return back()->withInput($request->only('nip'))->with('error', 'Email pegawai belum tersedia. OTP tidak dapat dikirim.');
        }

        /*
        |--------------------------------------------------------------------------
        | HAPUS OTP LAMA
        |--------------------------------------------------------------------------
        */

        SadarinOtp::query()->where('otp_identifier', $identifier)->where('otp_type', 'internal')->whereNull('otp_verified_at')->delete();

        /*
        |--------------------------------------------------------------------------
        | GENERATE OTP
        |--------------------------------------------------------------------------
        */

        $otpCode = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        /*
        |--------------------------------------------------------------------------
        | SIMPAN OTP
        |--------------------------------------------------------------------------
        */

        $otp = SadarinOtp::create([
            'otp_uid' => (string) Str::uuid(),

            'otp_identifier' => $identifier,

            'otp_type' => 'internal',

            'otp_code_hash' => Hash::make($otpCode),

            'otp_expires_at' => now()->addMinutes(10),

            'otp_verified_at' => null,

            'otp_last_attempt_at' => null,

            'otp_attempt_count' => 0,

            'otp_ip_address' => $request->ip(),

            'otp_user_agent' => $request->userAgent(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | FORMAT ROLE
        |--------------------------------------------------------------------------
        */

        $roles = $roleData
            ->map(function ($role) {
                return [
                    'id' => $role->role_id,

                    'name' => $role->role_name,

                    'description' => $role->role_description,
                ];
            })
            ->values()
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | PENDING LOGIN SESSION
        |--------------------------------------------------------------------------
        */

        session([
            'sadarin_login_pending' => true,

            'sadarin_login_otp_id' => $otp->otp_id,

            'sadarin_login_otp_uid' => $otp->otp_uid,

            'sadarin_login_user' => [
                'id' => $samperinUserId,

                'nama' => $nama,

                'nip' => $nip,

                'email' => $email,

                'jabatan' => $pegawai['jabatan'] ?? null,

                'jabatan_id' => $pegawai['jabatan_id'] ?? null,

                'bidang_id' => $pegawai['bidang_id'] ?? null,

                'bidang' => $pegawai['bidang'] ?? null,

                'eselon' => $pegawai['eselon'] ?? null,

                'hp' => $pegawai['hp'] ?? null,

                'pendidikan_jenjang' => $pegawai['pendidikan_jenjang'] ?? null,

                'pendidikan_jurusan' => $pegawai['pendidikan_jurusan'] ?? null,

                'golongan_nama' => $pegawai['golongan_nama'] ?? null,

                'golongan_pangkat' => $pegawai['golongan_pangkat'] ?? null,

                'jeniskerja' => $pegawai['jeniskerja'] ?? null,
            ],

            'sadarin_login_roles' => $roles,
        ]);

        /*
        |--------------------------------------------------------------------------
        | DEVELOPMENT OTP
        |--------------------------------------------------------------------------
        |
        | Sementara OTP masuk log.
        | Nanti diganti dengan email.
        |
        */

        Log::info('SADARIN OTP GENERATED', [
            'identifier' => $identifier,

            'email' => $email,

            'otp' => $otpCode,

            'expires_at' => $otp->otp_expires_at,
        ]);

        return redirect()->route('sadarin.login.otp')->with('success', 'Login berhasil. Silakan masukkan kode OTP.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW OTP
    |--------------------------------------------------------------------------
    */

    public function showOtp()
    {
        if (!session('sadarin_login_pending')) {
            return redirect()->route('sadarin.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $pegawai = session('sadarin_login_user');

        return view('LoginPage.otp', [
            'pegawai' => $pegawai,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | VERIFY OTP
    |--------------------------------------------------------------------------
    */

    public function verifyOtp(Request $request)
    {
        if (!session('sadarin_login_pending')) {
            return redirect()->route('sadarin.login')->with('error', 'Sesi login telah berakhir. Silakan login kembali.');
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDASI OTP
        |--------------------------------------------------------------------------
        */

        $validator = Validator::make(
            $request->all(),
            [
                'otp' => ['required', 'digits:6'],
            ],
            [
                'otp.required' => 'Kode OTP wajib diisi.',
                'otp.digits' => 'Kode OTP harus terdiri dari 6 angka.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL OTP
        |--------------------------------------------------------------------------
        */

        $otpId = session('sadarin_login_otp_id');

        $otp = SadarinOtp::find($otpId);

        if (!$otp) {
            session()->forget(['sadarin_login_pending', 'sadarin_login_otp_id', 'sadarin_login_otp_uid', 'sadarin_login_user', 'sadarin_login_roles']);

            return redirect()->route('sadarin.login')->with('error', 'Data OTP tidak ditemukan. Silakan login kembali.');
        }

        /*
        |--------------------------------------------------------------------------
        | OTP SUDAH DIGUNAKAN
        |--------------------------------------------------------------------------
        */

        if ($otp->otp_verified_at) {
            return back()->with('error', 'Kode OTP tersebut sudah digunakan.');
        }

        /*
        |--------------------------------------------------------------------------
        | OTP EXPIRED
        |--------------------------------------------------------------------------
        */

        if (!$otp->otp_expires_at || now()->greaterThan($otp->otp_expires_at)) {
            return back()->with('error', 'Kode OTP telah kedaluwarsa. Silakan login kembali.');
        }

        /*
        |--------------------------------------------------------------------------
        | MAX ATTEMPT
        |--------------------------------------------------------------------------
        */

        $maxAttempts = 5;

        if ($otp->otp_attempt_count >= $maxAttempts) {
            return back()->with('error', 'Batas percobaan OTP telah tercapai. Silakan login kembali.');
        }

        /*
        |--------------------------------------------------------------------------
        | TAMBAH ATTEMPT
        |--------------------------------------------------------------------------
        */

        $otp->increment('otp_attempt_count');

        $otp->update([
            'otp_last_attempt_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | CEK OTP
        |--------------------------------------------------------------------------
        */

        if (!Hash::check($request->otp, $otp->otp_code_hash)) {
            SadarinAccessLogService::log(action: 'otp.failed', userType: 'user', samperinUserId: $pegawai['id'] ?? null);

            $remaining = max(0, $maxAttempts - $otp->otp_attempt_count);

            return back()->with('error', "Kode OTP salah. Sisa percobaan: {$remaining}.");
        }

        /*
        |--------------------------------------------------------------------------
        | OTP BERHASIL
        |--------------------------------------------------------------------------
        */

        $otp->update([
            'otp_verified_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | DATA SESSION
        |--------------------------------------------------------------------------
        */

        $pegawai = session('sadarin_login_user');

        $roles = session('sadarin_login_roles', []);

        if (!$pegawai || empty($roles)) {
            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('sadarin.login')->with('error', 'Data login tidak lengkap. Silakan login kembali.');
        }


        SadarinAccessLogService::log(action: 'otp.success', userType: 'user', samperinUserId: $pegawai['id']);
        /*
        |--------------------------------------------------------------------------
        | ROLE AKTIF DEFAULT
        |--------------------------------------------------------------------------
        */

        $activeRole = $roles[0];

        /*
        |--------------------------------------------------------------------------
        | REGENERATE SESSION
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();

        /*
        |--------------------------------------------------------------------------
        | SESSION AUTHENTICATED
        |--------------------------------------------------------------------------
        */

        session([
            'sadarin_authenticated' => true,

            'sadarin_user_id' => $pegawai['id'],

            'sadarin_user_nip' => $pegawai['nip'],

            'sadarin_user_nama' => $pegawai['nama'],

            'sadarin_user_email' => $pegawai['email'],

            'sadarin_user_jabatan' => $pegawai['jabatan'],

            'sadarin_user_bidang' => $pegawai['bidang'],

            /*
            |--------------------------------------------------------------------------
            | SEMUA ROLE
            |--------------------------------------------------------------------------
            */

            'sadarin_roles' => $roles,

            /*
            |--------------------------------------------------------------------------
            | ROLE AKTIF
            |--------------------------------------------------------------------------
            */

            'sadarin_role_id' => $activeRole['id'],

            'sadarin_role_name' => $activeRole['name'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | HAPUS PENDING LOGIN
        |--------------------------------------------------------------------------
        */
        SadarinAccessLogService::log(action: 'login.success', userType: $activeRole['name'], samperinUserId: $pegawai['id']);
        session()->forget(['sadarin_login_pending', 'sadarin_login_otp_id', 'sadarin_login_otp_uid', 'sadarin_login_user', 'sadarin_login_roles']);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return $this->redirectByRole($activeRole['name'], $pegawai['nama']);
    }

    /*
    |--------------------------------------------------------------------------
    | SWITCH ROLE
    |--------------------------------------------------------------------------
    */

    public function switchRole(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | CEK LOGIN
        |--------------------------------------------------------------------------
        */

        if (!session('sadarin_authenticated')) {
            return redirect()->route('sadarin.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDASI ROLE
        |--------------------------------------------------------------------------
        */

        $validator = Validator::make(
            $request->all(),
            [
                'role_id' => ['required', 'integer'],
            ],
            [
                'role_id.required' => 'Role wajib dipilih.',
                'role_id.integer' => 'Role tidak valid.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $roleId = (int) $request->role_id;

        /*
        |--------------------------------------------------------------------------
        | AMBIL ROLE DARI SESSION
        |--------------------------------------------------------------------------
        */

        $roles = session('sadarin_roles', []);

        $selectedRole = collect($roles)->firstWhere('id', $roleId);

        /*
        |--------------------------------------------------------------------------
        | ROLE TIDAK DIMILIKI
        |--------------------------------------------------------------------------
        */

        if (!$selectedRole) {
            return back()->with('error', 'Anda tidak memiliki akses ke role tersebut.');
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE ACTIVE ROLE
        |--------------------------------------------------------------------------
        */

        session([
            'sadarin_role_id' => $selectedRole['id'],

            'sadarin_role_name' => $selectedRole['name'],
        ]);

        SadarinAccessLogService::log(action: 'role.switch', userType: $selectedRole['name'], samperinUserId: session('sadarin_user_id'));

        /*
        |--------------------------------------------------------------------------
        | REDIRECT SESUAI ROLE
        |--------------------------------------------------------------------------
        */

        return $this->redirectByRole($selectedRole['name'], session('sadarin_user_nama'));
    }

    /*
    |--------------------------------------------------------------------------
    | REDIRECT BY ROLE
    |--------------------------------------------------------------------------
    */

    private function redirectByRole(string $roleName, ?string $nama = null)
    {
        $message = $nama ? 'Selamat datang, ' . $nama . '.' : null;

        return match ($roleName) {
            'Administrator' => redirect()->route('sadarin.admin.dashboard.index')->with('success', $message),

            'Arsiparis' => redirect('/sadarin/arsiparis/dashboard')->with('success', $message),

            'Pengguna Internal' => redirect('/sadarin/dashboard')->with('success', $message),

            default => redirect()->route('sadarin.login')->with('error', 'Role akun tidak dikenali.'),
        };
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        SadarinAccessLogService::log(action: 'logout', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'));

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('sadarin.login')->with('success', 'Anda telah keluar dari SADARIN.');
    }
}