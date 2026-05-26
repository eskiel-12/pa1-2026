<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Akomodasi;
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
        return view('admin.akomodasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string|max:255',
            'kontak' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|max:5120',
        ]);

        $data = $request->only(['nama','deskripsi','lokasi','kontak']);
        $data['slug'] = Str::slug($request->nama);
        $data['user_id'] = auth()->id();

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
        return view('admin.akomodasi.edit', compact('item'));
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
        ]);

        $data = $request->only(['nama','deskripsi','lokasi','kontak']);
        $data['slug'] = Str::slug($request->nama);

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
