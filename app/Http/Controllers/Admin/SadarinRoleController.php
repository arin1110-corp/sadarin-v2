<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SadarinRole;
use App\Services\SadarinAccessLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SadarinRoleController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->search);

        $roles = SadarinRole::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('role_name', 'like', "%{$search}%")->orWhere('role_description', 'like', "%{$search}%");
                });
            })
            ->orderBy('role_name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.role.index', compact('roles', 'search'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'role_name' => ['required', 'string', 'max:100', 'unique:sadarin_role,role_name'],

                'role_description' => ['nullable', 'string'],
            ],
            [
                'role_name.required' => 'Nama role wajib diisi.',
                'role_name.max' => 'Nama role maksimal 100 karakter.',
                'role_name.unique' => 'Nama role sudah digunakan.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $role = SadarinRole::create([
            'role_name' => trim($request->role_name),

            'role_description' => $request->role_description ? trim($request->role_description) : null,

            'role_is_active' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'role.create', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'), objectType: 'role', objectId: $role->role_id);

        return redirect()->route('sadarin.admin.role.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $role = SadarinRole::findOrFail($id);

        return view('admin.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = SadarinRole::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'role_name' => ['required', 'string', 'max:100', 'unique:sadarin_role,role_name,' . $role->role_id . ',role_id'],

                'role_description' => ['nullable', 'string'],

                'role_is_active' => ['nullable', 'boolean'],
            ],
            [
                'role_name.required' => 'Nama role wajib diisi.',
                'role_name.max' => 'Nama role maksimal 100 karakter.',
                'role_name.unique' => 'Nama role sudah digunakan.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $role->update([
            'role_name' => trim($request->role_name),

            'role_description' => $request->role_description ? trim($request->role_description) : null,

            'role_is_active' => $request->boolean('role_is_active'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'role.update', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'), objectType: 'role', objectId: $role->role_id);

        return redirect()->route('sadarin.admin.role.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $role = SadarinRole::findOrFail($id);

        $role->update([
            'role_is_active' => false,
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'role.delete', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'), objectType: 'role', objectId: $role->role_id);

        return redirect()->route('sadarin.admin.role.index')->with('success', 'Role berhasil dinonaktifkan.');
    }
}