<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DestinasiController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.destinasi.index', compact('destinasi'));
    }

    public function create()
    {
        return view('admin.destinasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'tags' => 'nullable|string',
            'maps' => 'nullable|url',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'status' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);

        $kategori = Kategori::firstOrCreate([
            'nama' => $request->kategori,
        ], [
            'slug' => Str::slug($request->kategori),
            'deskripsi' => null,
        ]);
        $data['kategori_id'] = $kategori->id;

        // Handle tags
        if ($request->tags) {
            $data['tags'] = json_encode(array_map('trim', explode(',', $request->tags)));
        }

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $filename = time() . '_' . Str::slug($request->nama) . '.' . $request->gambar->getClientOriginalExtension();
            $path = $request->gambar->storeAs('destinasi', $filename, 'public');
            $data['gambar'] = $path;
        }

        Destinasi::create($data);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $destinasi = Destinasi::findOrFail($id);
        return view('admin.destinasi.show', compact('destinasi'));
    }

    public function edit(string $id)
    {
        $destinasi = Destinasi::findOrFail($id);
        return view('admin.destinasi.edit', compact('destinasi'));
    }

    public function update(Request $request, string $id)
    {
        $destinasi = Destinasi::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'tags' => 'nullable|string',
            'maps' => 'nullable|url',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'status' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama);

        $kategori = Kategori::firstOrCreate([
            'nama' => $request->kategori,
        ], [
            'slug' => Str::slug($request->kategori),
            'deskripsi' => null,
        ]);
        $data['kategori_id'] = $kategori->id;

        // Handle tags
        if ($request->tags) {
            $data['tags'] = json_encode(array_map('trim', explode(',', $request->tags)));
        }

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image (support both old path format and new format)
            if ($destinasi->gambar) {
                // SUDAH DIPERBAIKI: Menggunakan disk('public')
                if (Storage::disk('public')->exists($destinasi->gambar)) {
                    Storage::disk('public')->delete($destinasi->gambar);
                }
                elseif (file_exists(public_path($destinasi->gambar))) {
                    unlink(public_path($destinasi->gambar));
                }
            }

            $filename = time() . '_' . Str::slug($request->nama) . '.' . $request->gambar->getClientOriginalExtension();
            $path = $request->gambar->storeAs('destinasi', $filename, 'public');
            $data['gambar'] = $path;
        }

        $destinasi->update($data);

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $destinasi = Destinasi::findOrFail($id);

        // Delete image file (support both storage and public paths)
        if ($destinasi->gambar) {
            // SUDAH DIPERBAIKI: Menggunakan disk('public')
            if (Storage::disk('public')->exists($destinasi->gambar)) {
                Storage::disk('public')->delete($destinasi->gambar);
            }
            elseif (file_exists(public_path($destinasi->gambar))) {
                unlink(public_path($destinasi->gambar));
            }
        }

        $destinasi->delete();

        return redirect()->route('admin.destinasi.index')->with('success', 'Destinasi berhasil dihapus');
    }
}