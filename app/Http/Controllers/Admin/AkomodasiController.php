<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Akomodasi;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AkomodasiController extends Controller
{
    public function index()
    {
        $items = Akomodasi::latest()->paginate(10);
        return view('admin.akomodasi.index', compact('items'));
    }

    public function show($id)
    {
        $item = Akomodasi::findOrFail($id);
        return view('admin.akomodasi.show', compact('item'));
    }

    public function create()
    {
        $destinasis = Destinasi::where('status', true)->orderBy('nama')->get();
        return view('admin.akomodasi.create', compact('destinasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|max:5120',
            'destinasi_id' => 'nullable|exists:destinasi,id',
            'status' => 'nullable|boolean',
        ]);

        $data = $request->only(['nama','deskripsi','lokasi','kontak','destinasi_id']);
        $data['slug'] = Str::slug($request->nama);
        $data['user_id'] = auth()->id();
        $data['status'] = $request->has('status');

        if ($request->hasFile('gambar')) {
            $filename = time().'_'.Str::slug($request->nama).'.'.$request->gambar->getClientOriginalExtension();
            $data['gambar'] = $request->file('gambar')->storeAs('akomodasi', $filename, 'public');
        }

        Akomodasi::create($data);
        return redirect()->route('admin.akomodasi.index')->with('success','Akomodasi ditambahkan');
    }

    public function edit($id)
    {
        $item = Akomodasi::findOrFail($id);
        $destinasis = Destinasi::where('status', true)->orderBy('nama')->get();
        return view('admin.akomodasi.edit', compact('item', 'destinasis'));
    }

    public function update(Request $request, $id)
    {
        $item = Akomodasi::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|max:5120',
            'destinasi_id' => 'nullable|exists:destinasi,id',
            'status' => 'nullable|boolean',
        ]);

        $data = $request->only(['nama','deskripsi','lokasi','kontak','destinasi_id']);
        $data['slug'] = Str::slug($request->nama);
        $data['status'] = $request->has('status');

        if ($request->hasFile('gambar')) {
            if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
                Storage::disk('public')->delete($item->gambar);
            }
            $filename = time().'_'.Str::slug($request->nama).'.'.$request->gambar->getClientOriginalExtension();
            $data['gambar'] = $request->file('gambar')->storeAs('akomodasi', $filename, 'public');
        }

        $item->update($data);
        return redirect()->route('admin.akomodasi.index')->with('success','Akomodasi diperbarui');
    }

    public function destroy($id)
    {
        $item = Akomodasi::findOrFail($id);
        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }
        $item->delete();
        return redirect()->route('admin.akomodasi.index')->with('success','Akomodasi dihapus');
    }
}
