<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\SadarinDocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SadarinDocumentTypeController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->search ?? '');

        $documentTypes = SadarinDocumentType::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('document_type_name', 'like', "%{$search}%")->orWhere('document_type_description', 'like', "%{$search}%");
                });
            })
            ->orderBy('document_type_name')
            ->paginate(20)
            ->withQueryString();

        return view('Dashboard.master.document-type.index', compact('documentTypes'));
    }

    public function create()
    {
        return view('Dashboard.master.document-type.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'document_type_name' => ['required', 'string', 'max:150'],
                'document_type_description' => ['nullable', 'string'],
            ],
            [
                'document_type_name.required' => 'Nama jenis dokumen wajib diisi.',
                'document_type_name.max' => 'Nama jenis dokumen maksimal 150 karakter.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $name = trim($request->document_type_name);

        $exists = SadarinDocumentType::query()
            ->whereRaw('LOWER(document_type_name) = ?', [strtolower($name)])
            ->exists();

        if ($exists) {
            return back()
                ->withErrors([
                    'document_type_name' => 'Jenis dokumen tersebut sudah tersedia.',
                ])
                ->withInput();
        }

        SadarinDocumentType::create([
            'document_type_name' => $name,
            'document_type_description' => $request->document_type_description,
            'document_type_is_active' => true,
        ]);

        return redirect()->route('sadarin.admin.master.document-type.index')->with('success', 'Jenis dokumen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $documentType = SadarinDocumentType::findOrFail($id);

        return view('Dashboard.master.document-type.edit', compact('documentType'));
    }

    public function update(Request $request, $id)
    {
        $documentType = SadarinDocumentType::findOrFail($id);

        $validator = Validator::make(
            $request->all(),
            [
                'document_type_name' => ['required', 'string', 'max:150'],
                'document_type_description' => ['nullable', 'string'],
            ],
            [
                'document_type_name.required' => 'Nama jenis dokumen wajib diisi.',
                'document_type_name.max' => 'Nama jenis dokumen maksimal 150 karakter.',
            ],
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $name = trim($request->document_type_name);

        $exists = SadarinDocumentType::query()
            ->whereRaw('LOWER(document_type_name) = ?', [strtolower($name)])
            ->where('document_type_id', '!=', $documentType->document_type_id)
            ->exists();

        if ($exists) {
            return back()
                ->withErrors([
                    'document_type_name' => 'Jenis dokumen tersebut sudah tersedia.',
                ])
                ->withInput();
        }

        $documentType->update([
            'document_type_name' => $name,
            'document_type_description' => $request->document_type_description,
            'document_type_is_active' => $request->boolean('document_type_is_active'),
        ]);

        return redirect()->route('sadarin.admin.master.document-type.index')->with('success', 'Jenis dokumen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $documentType = SadarinDocumentType::findOrFail($id);

        $documentType->update([
            'document_type_is_active' => false,
        ]);

        return redirect()->route('sadarin.admin.master.document-type.index')->with('success', 'Jenis dokumen berhasil dinonaktifkan.');
    }
}