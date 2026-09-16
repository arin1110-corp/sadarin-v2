<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\SadarinTag;
use App\Services\SadarinAccessLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SadarinTagController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->search ?? '');

        $tags = SadarinTag::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('tag_name', 'like', "%{$search}%")
                        ->orWhere('tag_slug', 'like', "%{$search}%")
                        ->orWhere('tag_description', 'like', "%{$search}%");
                });
            })
            ->orderBy('tag_name')
            ->paginate(20)
            ->withQueryString();

        return view('Dashboard.master.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('Dashboard.master.tag.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tag_name' => ['required', 'string', 'max:100'],

                'tag_description' => ['nullable', 'string'],
            ],
            [
                'tag_name.required' => 'Nama tag wajib diisi.',

                'tag_name.max' => 'Nama tag maksimal 100 karakter.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $name = trim($request->tag_name);

        /*
        |--------------------------------------------------------------------------
        | CEK NAMA
        |--------------------------------------------------------------------------
        */

        $nameExists = SadarinTag::query()
            ->whereRaw('LOWER(tag_name) = ?', [strtolower($name)])
            ->exists();

        if ($nameExists) {
            return back()
                ->withErrors([
                    'tag_name' => 'Tag tersebut sudah tersedia.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | GENERATE SLUG
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($name);

        $originalSlug = $slug;
        $counter = 1;

        while (SadarinTag::query()->where('tag_slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE
        |--------------------------------------------------------------------------
        */

        $tag = SadarinTag::create([
            'tag_name' => $name,

            'tag_slug' => $slug,

            'tag_description' => $request->tag_description,

            'tag_is_active' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'tag.create', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'), objectType: 'tag', objectId: $tag->tag_id);

        return redirect()->route('sadarin.admin.master.tag.index')->with('success', 'Tag berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tag = SadarinTag::findOrFail($id);

        return view('Dashboard.master.tag.edit', compact('tag'));
    }

    public function update(Request $request, $id)
    {
        $tag = SadarinTag::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'tag_name' => ['required', 'string', 'max:100'],

                'tag_description' => ['nullable', 'string'],
            ],
            [
                'tag_name.required' => 'Nama tag wajib diisi.',

                'tag_name.max' => 'Nama tag maksimal 100 karakter.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $name = trim($request->tag_name);

        /*
        |--------------------------------------------------------------------------
        | CEK NAMA
        |--------------------------------------------------------------------------
        */

        $nameExists = SadarinTag::query()
            ->whereRaw('LOWER(tag_name) = ?', [strtolower($name)])
            ->where('tag_id', '!=', $tag->tag_id)
            ->exists();

        if ($nameExists) {
            return back()
                ->withErrors([
                    'tag_name' => 'Tag tersebut sudah tersedia.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | GENERATE SLUG
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($name);

        $originalSlug = $slug;
        $counter = 1;

        while (SadarinTag::query()->where('tag_slug', $slug)->where('tag_id', '!=', $tag->tag_id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $tag->update([
            'tag_name' => $name,

            'tag_slug' => $slug,

            'tag_description' => $request->tag_description,

            'tag_is_active' => $request->boolean('tag_is_active'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'tag.update', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'), objectType: 'tag', objectId: $tag->tag_id);

        return redirect()->route('sadarin.admin.master.tag.index')->with('success', 'Tag berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $tag = SadarinTag::findOrFail($id);

        $tag->update([
            'tag_is_active' => false,
        ]);

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::log(action: 'tag.delete', userType: session('sadarin_role_name'), samperinUserId: session('sadarin_user_id'), objectType: 'tag', objectId: $tag->tag_id);

        return redirect()->route('sadarin.admin.master.tag.index')->with('success', 'Tag berhasil dinonaktifkan.');
    }
}