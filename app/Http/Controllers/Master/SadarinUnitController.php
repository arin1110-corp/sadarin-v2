<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\SadarinUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SadarinUnitController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = trim($request->search ?? '');

        $units = SadarinUnit::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('unit_name', 'like', "%{$search}%")->orWhere('unit_code', 'like', "%{$search}%");
                });
            })
            ->orderBy('unit_name')
            ->paginate(20)
            ->withQueryString();

        return view('Dashboard.master.unit.index', compact('units'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('Dashboard.master.unit.create');
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
                'unit_name' => ['required', 'string', 'max:255'],

                'unit_code' => ['nullable', 'string', 'max:100'],

                'unit_type' => ['required', 'in:induk,uptd'],

                'unit_description' => ['nullable', 'string'],
            ],
            [
                'unit_name.required' => 'Nama unit wajib diisi.',

                'unit_type.required' => 'Jenis unit wajib dipilih.',

                'unit_type.in' => 'Jenis unit tidak valid.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | CEK DUPLIKAT NAMA
        |--------------------------------------------------------------------------
        */

        $exists = SadarinUnit::query()
            ->where('unit_name', trim($request->unit_name))
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Nama unit sudah digunakan.');
        }

        /*
        |--------------------------------------------------------------------------
        | CEK DUPLIKAT KODE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('unit_code')) {
            $existsCode = SadarinUnit::query()
                ->where('unit_code', trim($request->unit_code))
                ->exists();

            if ($existsCode) {
                return back()->withInput()->with('error', 'Kode unit sudah digunakan.');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        SadarinUnit::create([
            'unit_name' => trim($request->unit_name),

            'unit_code' => $request->filled('unit_code') ? trim($request->unit_code) : null,

            'unit_type' => $request->unit_type,

            'unit_description' => $request->unit_description,

            'unit_is_active' => true,
        ]);

        return redirect()->route('sadarin.admin.master.unit.index')->with('success', 'Unit berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $unit = SadarinUnit::findOrFail($id);

        return view('master.unit.show', compact('unit'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $unit = SadarinUnit::findOrFail($id);

        return view('Dashboard.master.unit.edit', compact('unit'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $unit = SadarinUnit::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'unit_name' => ['required', 'string', 'max:255'],

                'unit_code' => ['nullable', 'string', 'max:100'],

                'unit_type' => ['required', 'in:induk,uptd'],

                'unit_description' => ['nullable', 'string'],

                'unit_is_active' => ['nullable', 'boolean'],
            ],
            [
                'unit_name.required' => 'Nama unit wajib diisi.',

                'unit_type.required' => 'Jenis unit wajib dipilih.',

                'unit_type.in' => 'Jenis unit tidak valid.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | CEK DUPLIKAT NAMA
        |--------------------------------------------------------------------------
        */

        $exists = SadarinUnit::query()
            ->where('unit_name', trim($request->unit_name))
            ->where('unit_id', '!=', $unit->unit_id)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Nama unit sudah digunakan.');
        }

        /*
        |--------------------------------------------------------------------------
        | CEK DUPLIKAT KODE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('unit_code')) {
            $existsCode = SadarinUnit::query()
                ->where('unit_code', trim($request->unit_code))
                ->where('unit_id', '!=', $unit->unit_id)
                ->exists();

            if ($existsCode) {
                return back()->withInput()->with('error', 'Kode unit sudah digunakan.');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $unit->update([
            'unit_name' => trim($request->unit_name),

            'unit_code' => $request->filled('unit_code') ? trim($request->unit_code) : null,

            'unit_type' => $request->unit_type,

            'unit_description' => $request->unit_description,

            'unit_is_active' => $request->boolean('unit_is_active'),
        ]);

        return redirect()->route('sadarin.master.unit.index')->with('success', 'Unit berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $unit = SadarinUnit::findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | NONAKTIFKAN
        |--------------------------------------------------------------------------
        */

        $unit->update([
            'unit_is_active' => false,
        ]);

        return redirect()->route('sadarin.master.unit.index')->with('success', 'Unit berhasil dinonaktifkan.');
    }
}