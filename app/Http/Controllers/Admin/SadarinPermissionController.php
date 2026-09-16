<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SadarinPermission;
use App\Services\SadarinAccessLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SadarinPermissionController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->search);

        $permissions = SadarinPermission::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('permission_name', 'like', "%{$search}%")
                        ->orWhere('permission_label', 'like', "%{$search}%")
                        ->orWhere('permission_description', 'like', "%{$search}%");
                });
            })
            ->orderBy('permission_name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.permission.index', compact('permissions', 'search'));
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'permission_name' => ['required', 'string', 'max:100', 'unique:sadarin_permission,permission_name'],

                'permission_label' => ['required', 'string', 'max:150'],

                'permission_description' => ['nullable', 'string'],
            ],
            [
                'permission_name.required' => 'Nama permission wajib diisi.',
                'permission_name.max' => 'Nama permission maksimal 100 karakter.',
                'permission_name.unique' => 'Nama permission sudah digunakan.',
                'permission_label.required' => 'Label permission wajib diisi.',
                'permission_label.max' => 'Label permission maksimal 150 karakter.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $permission = SadarinPermission::create([
            'permission_name' => trim($request->permission_name),
            'permission_label' => trim($request->permission_label),
            'permission_description' => $request->permission_description ? trim($request->permission_description) : null,
            'permission_is_active' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'permission.create', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'), objectType: 'permission', objectId: $permission->permission_id);

        return redirect()->route('sadarin.admin.permission.index')->with('success', 'Permission berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $permission = SadarinPermission::findOrFail($id);

        return view('admin.permission.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = SadarinPermission::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'permission_name' => ['required', 'string', 'max:100', 'unique:sadarin_permission,permission_name,' . $permission->permission_id . ',permission_id'],

                'permission_label' => ['required', 'string', 'max:150'],

                'permission_description' => ['nullable', 'string'],

                'permission_is_active' => ['nullable', 'boolean'],
            ],
            [
                'permission_name.required' => 'Nama permission wajib diisi.',
                'permission_name.max' => 'Nama permission maksimal 100 karakter.',
                'permission_name.unique' => 'Nama permission sudah digunakan.',
                'permission_label.required' => 'Label permission wajib diisi.',
                'permission_label.max' => 'Label permission maksimal 150 karakter.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $permission->update([
            'permission_name' => trim($request->permission_name),
            'permission_label' => trim($request->permission_label),
            'permission_description' => $request->permission_description ? trim($request->permission_description) : null,
            'permission_is_active' => $request->boolean('permission_is_active'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'permission.update', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'), objectType: 'permission', objectId: $permission->permission_id);

        return redirect()->route('sadarin.admin.permission.index')->with('success', 'Permission berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $permission = SadarinPermission::findOrFail($id);

        $permission->update([
            'permission_is_active' => false,
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'permission.delete', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'), objectType: 'permission', objectId: $permission->permission_id);

        return redirect()->route('sadarin.admin.permission.index')->with('success', 'Permission berhasil dinonaktifkan.');
    }
}