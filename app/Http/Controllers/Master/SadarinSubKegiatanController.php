<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\SadarinSubKegiatan;
use App\Models\SadarinKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SadarinSubKegiatanController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->search ?? '');

        $subKegiatans = SadarinSubKegiatan::query()
            ->select('sadarin_sub_kegiatan.*', 'sadarin_kegiatan.kegiatan_name')
            ->leftJoin('sadarin_kegiatan', 'sadarin_kegiatan.kegiatan_id', '=', 'sadarin_sub_kegiatan.sub_kegiatan_kegiatan_id')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('sadarin_sub_kegiatan.sub_kegiatan_name', 'like', "%{$search}%")
                        ->orWhere('sadarin_sub_kegiatan.sub_kegiatan_code', 'like', "%{$search}%")
                        ->orWhere('sadarin_kegiatan.kegiatan_name', 'like', "%{$search}%");
                });
            })
            ->orderBy('sadarin_sub_kegiatan.sub_kegiatan_name')
            ->paginate(20)
            ->withQueryString();

        return view('Dashboard.master.sub-kegiatan.index', compact('subKegiatans'));
    }

    public function create()
    {
        $kegiatans = SadarinKegiatan::query()->where('kegiatan_is_active', true)->orderBy('kegiatan_name')->get();

        return view('Dashboard.master.sub-kegiatan.create', compact('kegiatans'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'sub_kegiatan_kegiatan_id' => ['required', 'integer', 'exists:sadarin_kegiatan,kegiatan_id'],
                'sub_kegiatan_code' => ['nullable', 'string', 'max:100'],
                'sub_kegiatan_name' => ['required', 'string', 'max:255'],
                'sub_kegiatan_description' => ['nullable', 'string'],
            ],
            [
                'sub_kegiatan_kegiatan_id.required' => 'Kegiatan wajib dipilih.',

                'sub_kegiatan_kegiatan_id.exists' => 'Kegiatan tidak ditemukan.',

                'sub_kegiatan_name.required' => 'Nama sub kegiatan wajib diisi.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $kegiatan = SadarinKegiatan::findOrFail($request->sub_kegiatan_kegiatan_id);

        if (!$kegiatan->kegiatan_is_active) {
            return back()
                ->withErrors([
                    'sub_kegiatan_kegiatan_id' => 'Kegiatan yang dipilih tidak aktif.',
                ])
                ->withInput();
        }

        $name = trim($request->sub_kegiatan_name);
        $code = filled($request->sub_kegiatan_code) ? trim($request->sub_kegiatan_code) : null;

        $duplicateName = SadarinSubKegiatan::query()
            ->where('sub_kegiatan_kegiatan_id', $request->sub_kegiatan_kegiatan_id)
            ->whereRaw('LOWER(sub_kegiatan_name) = ?', [strtolower($name)])
            ->exists();

        if ($duplicateName) {
            return back()
                ->withErrors([
                    'sub_kegiatan_name' => 'Nama sub kegiatan sudah digunakan pada kegiatan tersebut.',
                ])
                ->withInput();
        }

        if ($code) {
            $duplicateCode = SadarinSubKegiatan::query()->where('sub_kegiatan_code', $code)->exists();

            if ($duplicateCode) {
                return back()
                    ->withErrors([
                        'sub_kegiatan_code' => 'Kode sub kegiatan sudah digunakan.',
                    ])
                    ->withInput();
            }
        }

        SadarinSubKegiatan::create([
            'sub_kegiatan_kegiatan_id' => $request->sub_kegiatan_kegiatan_id,

            'sub_kegiatan_code' => $code,

            'sub_kegiatan_name' => $name,

            'sub_kegiatan_description' => $request->sub_kegiatan_description,

            'sub_kegiatan_is_active' => true,
        ]);

        return redirect()->route('sadarin.admin.master.sub-kegiatan.index')->with('success', 'Sub kegiatan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $subKegiatan = SadarinSubKegiatan::findOrFail($id);

        $kegiatans = SadarinKegiatan::query()->where('kegiatan_is_active', true)->orWhere('kegiatan_id', $subKegiatan->sub_kegiatan_kegiatan_id)->orderBy('kegiatan_name')->get();

        return view('Dashboard.master.sub-kegiatan.edit', compact('subKegiatan', 'kegiatans'));
    }

    public function update(Request $request, $id)
    {
        $subKegiatan = SadarinSubKegiatan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'sub_kegiatan_kegiatan_id' => ['required', 'integer', 'exists:sadarin_kegiatan,kegiatan_id'],
            'sub_kegiatan_code' => ['nullable', 'string', 'max:100'],
            'sub_kegiatan_name' => ['required', 'string', 'max:255'],
            'sub_kegiatan_description' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $kegiatan = SadarinKegiatan::findOrFail($request->sub_kegiatan_kegiatan_id);

        if (!$kegiatan->kegiatan_is_active) {
            return back()
                ->withErrors([
                    'sub_kegiatan_kegiatan_id' => 'Kegiatan yang dipilih tidak aktif.',
                ])
                ->withInput();
        }

        $name = trim($request->sub_kegiatan_name);

        $code = filled($request->sub_kegiatan_code) ? trim($request->sub_kegiatan_code) : null;

        $duplicateName = SadarinSubKegiatan::query()
            ->where('sub_kegiatan_kegiatan_id', $request->sub_kegiatan_kegiatan_id)
            ->whereRaw('LOWER(sub_kegiatan_name) = ?', [strtolower($name)])
            ->where('sub_kegiatan_id', '!=', $subKegiatan->sub_kegiatan_id)
            ->exists();

        if ($duplicateName) {
            return back()
                ->withErrors([
                    'sub_kegiatan_name' => 'Nama sub kegiatan sudah digunakan pada kegiatan tersebut.',
                ])
                ->withInput();
        }

        if ($code) {
            $duplicateCode = SadarinSubKegiatan::query()->where('sub_kegiatan_code', $code)->where('sub_kegiatan_id', '!=', $subKegiatan->sub_kegiatan_id)->exists();

            if ($duplicateCode) {
                return back()
                    ->withErrors([
                        'sub_kegiatan_code' => 'Kode sub kegiatan sudah digunakan.',
                    ])
                    ->withInput();
            }
        }

        $subKegiatan->update([
            'sub_kegiatan_kegiatan_id' => $request->sub_kegiatan_kegiatan_id,

            'sub_kegiatan_code' => $code,

            'sub_kegiatan_name' => $name,

            'sub_kegiatan_description' => $request->sub_kegiatan_description,

            'sub_kegiatan_is_active' => $request->boolean('sub_kegiatan_is_active'),
        ]);

        return redirect()->route('sadarin.admin.master.sub-kegiatan.index')->with('success', 'Sub kegiatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $subKegiatan = SadarinSubKegiatan::findOrFail($id);

        $subKegiatan->update([
            'sub_kegiatan_is_active' => false,
        ]);

        return redirect()->route('sadarin.admin.master.sub-kegiatan.index')->with('success', 'Sub kegiatan berhasil dinonaktifkan.');
    }
}