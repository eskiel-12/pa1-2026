<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::latest()->paginate(10);
        return view('admin.umkm.index', compact('umkms'));
    }

    public function create()
    {
        $destinasis = Destinasi::where('status', true)->orderBy('nama')->get();
        return view('admin.umkm.create', compact('destinasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'destinasi_id' => 'nullable|exists:destinasi,id',
        ]);

        $data = $request->only(['nama', 'deskripsi', 'lokasi', 'kontak', 'destinasi_id']);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('gambar')) {
            $filename = time() . '_' . Str::slug($request->nama) . '.' . $request->gambar->getClientOriginalExtension();
            $data['gambar'] = $request->file('gambar')->storeAs('umkm', $filename, 'public');
        }

        Umkm::create($data);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil ditambahkan');
    }

    public function show($id)
    {
        $umkm = Umkm::findOrFail($id);
        return view('admin.umkm.show', compact('umkm'));
    }

    public function edit($id)
    {
        $umkm = Umkm::findOrFail($id);
        $destinasis = Destinasi::where('status', true)->orderBy('nama')->get();
        return view('admin.umkm.edit', compact('umkm', 'destinasis'));
    }

    public function update(Request $request, $id)
    {
        $umkm = Umkm::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'destinasi_id' => 'nullable|exists:destinasi,id',
        ]);

        $data = $request->only(['nama', 'deskripsi', 'lokasi', 'kontak', 'destinasi_id']);

        if ($request->hasFile('gambar')) {
            if ($umkm->gambar && Storage::disk('public')->exists($umkm->gambar)) {
                Storage::disk('public')->delete($umkm->gambar);
            }

            $filename = time() . '_' . Str::slug($request->nama) . '.' . $request->gambar->getClientOriginalExtension();
            $data['gambar'] = $request->file('gambar')->storeAs('umkm', $filename, 'public');
        }

        $umkm->update($data);

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil diperbarui');
    }

    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);

        if ($umkm->gambar && Storage::disk('public')->exists($umkm->gambar)) {
            Storage::disk('public')->delete($umkm->gambar);
        }

        $umkm->delete();

        return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil dihapus');
    }
}
