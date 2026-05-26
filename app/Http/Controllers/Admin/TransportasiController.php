<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transportasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TransportasiController extends Controller
{
    public function index()
    {
        $items = Transportasi::latest()->paginate(10);
        return view('admin.transportasi.index', compact('items'));
    }

    public function show($id)
    {
        $item = Transportasi::findOrFail($id);
        return view('admin.transportasi.show', compact('item'));
    }

    public function create()
    {
        return view('admin.transportasi.create');
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
            $data['gambar'] = $request->file('gambar')->storeAs('transportasi', $filename, 'public');
        }

        Transportasi::create($data);
        return redirect()->route('admin.transportasi.index')->with('success','Transportasi ditambahkan');
    }

    public function edit($id)
    {
        $item = Transportasi::findOrFail($id);
        return view('admin.transportasi.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Transportasi::findOrFail($id);

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
            $data['gambar'] = $request->file('gambar')->storeAs('transportasi', $filename, 'public');
        }

        $item->update($data);
        return redirect()->route('admin.transportasi.index')->with('success','Transportasi diperbarui');
    }

    public function destroy($id)
    {
        $item = Transportasi::findOrFail($id);
        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }
        $item->delete();
        return redirect()->route('admin.transportasi.index')->with('success','Transportasi dihapus');
    }
}
