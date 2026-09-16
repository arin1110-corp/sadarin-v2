<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\SadarinKegiatan;
use App\Models\SadarinProgram;
use App\Services\SadarinAccessLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SadarinKegiatanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = trim($request->search ?? '');

        $kegiatans = SadarinKegiatan::query()
            ->select('sadarin_kegiatan.*', 'sadarin_program.program_name')
            ->leftJoin('sadarin_program', 'sadarin_program.program_id', '=', 'sadarin_kegiatan.kegiatan_program_id')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('sadarin_kegiatan.kegiatan_name', 'like', "%{$search}%")
                        ->orWhere('sadarin_kegiatan.kegiatan_code', 'like', "%{$search}%")
                        ->orWhere('sadarin_program.program_name', 'like', "%{$search}%");
                });
            })
            ->orderBy('sadarin_kegiatan.kegiatan_name')
            ->paginate(20)
            ->withQueryString();

        return view('Dashboard.master.kegiatan.index', compact('kegiatans'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $programs = SadarinProgram::query()->where('program_is_active', true)->orderBy('program_name')->get();

        return view('Dashboard.master.kegiatan.create', compact('programs'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kegiatan_program_id' => ['required', 'integer', 'exists:sadarin_program,program_id'],

                'kegiatan_name' => ['required', 'string', 'max:255'],

                'kegiatan_code' => ['nullable', 'string', 'max:100'],

                'kegiatan_description' => ['nullable', 'string'],
            ],
            [
                'kegiatan_program_id.required' => 'Program wajib dipilih.',

                'kegiatan_program_id.exists' => 'Program tidak ditemukan.',

                'kegiatan_name.required' => 'Nama kegiatan wajib diisi.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | CEK PROGRAM
        |--------------------------------------------------------------------------
        */

        $program = SadarinProgram::query()->where('program_id', $request->kegiatan_program_id)->where('program_is_active', true)->first();

        if (!$program) {
            return back()->withInput()->with('error', 'Program yang dipilih tidak aktif.');
        }

        /*
        |--------------------------------------------------------------------------
        | CEK DUPLIKAT NAMA
        |--------------------------------------------------------------------------
        */

        $exists = SadarinKegiatan::query()
            ->where('kegiatan_program_id', $request->kegiatan_program_id)
            ->where('kegiatan_name', trim($request->kegiatan_name))
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Nama kegiatan sudah digunakan pada program tersebut.');
        }

        /*
        |--------------------------------------------------------------------------
        | CEK KODE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('kegiatan_code')) {
            $existsCode = SadarinKegiatan::query()
                ->where('kegiatan_code', trim($request->kegiatan_code))
                ->exists();

            if ($existsCode) {
                return back()->withInput()->with('error', 'Kode kegiatan sudah digunakan.');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        $kegiatan = SadarinKegiatan::create([
            'kegiatan_program_id' => $request->kegiatan_program_id,

            'kegiatan_name' => trim($request->kegiatan_name),

            'kegiatan_code' => $request->filled('kegiatan_code') ? trim($request->kegiatan_code) : null,

            'kegiatan_description' => $request->kegiatan_description,

            'kegiatan_is_active' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'kegiatan.create', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'), objectType: 'kegiatan', objectId: $kegiatan->kegiatan_id);

        return redirect()->route('sadarin.admin.master.kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $kegiatan = SadarinKegiatan::findOrFail($id);

        $programs = SadarinProgram::query()->where('program_is_active', true)->orWhere('program_id', $kegiatan->kegiatan_program_id)->orderBy('program_name')->get();

        return view('Dashboard.master.kegiatan.edit', compact('kegiatan', 'programs'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $kegiatan = SadarinKegiatan::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'kegiatan_program_id' => ['required', 'integer', 'exists:sadarin_program,program_id'],

                'kegiatan_name' => ['required', 'string', 'max:255'],

                'kegiatan_code' => ['nullable', 'string', 'max:100'],

                'kegiatan_description' => ['nullable', 'string'],

                'kegiatan_is_active' => ['nullable', 'boolean'],
            ],
            [
                'kegiatan_program_id.required' => 'Program wajib dipilih.',

                'kegiatan_name.required' => 'Nama kegiatan wajib diisi.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | CEK PROGRAM
        |--------------------------------------------------------------------------
        */

        $program = SadarinProgram::query()->where('program_id', $request->kegiatan_program_id)->where('program_is_active', true)->first();

        if (!$program) {
            return back()->withInput()->with('error', 'Program yang dipilih tidak aktif.');
        }

        /*
        |--------------------------------------------------------------------------
        | CEK DUPLIKAT NAMA
        |--------------------------------------------------------------------------
        */

        $exists = SadarinKegiatan::query()
            ->where('kegiatan_program_id', $request->kegiatan_program_id)
            ->where('kegiatan_name', trim($request->kegiatan_name))
            ->where('kegiatan_id', '!=', $kegiatan->kegiatan_id)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Nama kegiatan sudah digunakan pada program tersebut.');
        }

        /*
        |--------------------------------------------------------------------------
        | CEK KODE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('kegiatan_code')) {
            $existsCode = SadarinKegiatan::query()
                ->where('kegiatan_code', trim($request->kegiatan_code))
                ->where('kegiatan_id', '!=', $kegiatan->kegiatan_id)
                ->exists();

            if ($existsCode) {
                return back()->withInput()->with('error', 'Kode kegiatan sudah digunakan.');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $kegiatan->update([
            'kegiatan_program_id' => $request->kegiatan_program_id,

            'kegiatan_name' => trim($request->kegiatan_name),

            'kegiatan_code' => $request->filled('kegiatan_code') ? trim($request->kegiatan_code) : null,

            'kegiatan_description' => $request->kegiatan_description,

            'kegiatan_is_active' => $request->boolean('kegiatan_is_active'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'kegiatan.update', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'), objectType: 'kegiatan', objectId: $kegiatan->kegiatan_id);

        return redirect()->route('sadarin.admin.master.kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $kegiatan = SadarinKegiatan::findOrFail($id);

        $kegiatan->update([
            'kegiatan_is_active' => false,
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'kegiatan.delete', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'), objectType: 'kegiatan', objectId: $kegiatan->kegiatan_id);

        return redirect()->route('sadarin.admin.master.kegiatan.index')->with('success', 'Kegiatan berhasil dinonaktifkan.');
    }
}