<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\SadarinProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SadarinProgramController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = trim($request->search ?? '');

        $programs = SadarinProgram::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('program_name', 'like', "%{$search}%")->orWhere('program_code', 'like', "%{$search}%");
                });
            })
            ->orderBy('program_name')
            ->paginate(20)
            ->withQueryString();

        return view('Dashboard.master.program.index', compact('programs'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('Dashboard.master.program.create');
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
                'program_name' => ['required', 'string', 'max:255'],

                'program_code' => ['nullable', 'string', 'max:100'],

                'program_description' => ['nullable', 'string'],
            ],
            [
                'program_name.required' => 'Nama program wajib diisi.',
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

        $exists = SadarinProgram::query()
            ->where('program_name', trim($request->program_name))
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Nama program sudah digunakan.');
        }

        /*
        |--------------------------------------------------------------------------
        | CEK DUPLIKAT KODE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('program_code')) {
            $existsCode = SadarinProgram::query()
                ->where('program_code', trim($request->program_code))
                ->exists();

            if ($existsCode) {
                return back()->withInput()->with('error', 'Kode program sudah digunakan.');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        SadarinProgram::create([
            'program_name' => trim($request->program_name),

            'program_code' => $request->filled('program_code') ? trim($request->program_code) : null,

            'program_description' => $request->program_description,

            'program_is_active' => true,
        ]);

        return redirect()->route('sadarin.admin.master.program.index')->with('success', 'Program berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $program = SadarinProgram::findOrFail($id);

        return view('Dashboard.master.program.edit', compact('program'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $program = SadarinProgram::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'program_name' => ['required', 'string', 'max:255'],

                'program_code' => ['nullable', 'string', 'max:100'],

                'program_description' => ['nullable', 'string'],

                'program_is_active' => ['nullable', 'boolean'],
            ],
            [
                'program_name.required' => 'Nama program wajib diisi.',
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

        $exists = SadarinProgram::query()
            ->where('program_name', trim($request->program_name))
            ->where('program_id', '!=', $program->program_id)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Nama program sudah digunakan.');
        }

        /*
        |--------------------------------------------------------------------------
        | CEK DUPLIKAT KODE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('program_code')) {
            $existsCode = SadarinProgram::query()
                ->where('program_code', trim($request->program_code))
                ->where('program_id', '!=', $program->program_id)
                ->exists();

            if ($existsCode) {
                return back()->withInput()->with('error', 'Kode program sudah digunakan.');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $program->update([
            'program_name' => trim($request->program_name),

            'program_code' => $request->filled('program_code') ? trim($request->program_code) : null,

            'program_description' => $request->program_description,

            'program_is_active' => $request->boolean('program_is_active'),
        ]);

        return redirect()->route('sadarin.admin.master.program.index')->with('success', 'Program berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $program = SadarinProgram::findOrFail($id);

        $program->update([
            'program_is_active' => false,
        ]);

        return redirect()->route('sadarin.admin.master.program.index')->with('success', 'Program berhasil dinonaktifkan.');
    }
}