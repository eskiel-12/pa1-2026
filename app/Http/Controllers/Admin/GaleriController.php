<?php
// app/Http/Controllers/Admin/GaleriController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class GaleriController extends Controller
{
    public function index()
    {
        $galeri = Galeri::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.galeri.index', compact('galeri'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg',
            'lokasi' => 'nullable|string',
            'tanggal_foto' => 'nullable|date',
            'status' => 'nullable|boolean'
        ]);

        // Upload gambar
        $gambar = $request->file('gambar');
        $folder = 'image/galeri';
        $filename = time() . '_' . Str::slug($request->judul) . '.' . $gambar->getClientOriginalExtension();
        $path = $gambar->storeAs($folder, $filename, 'public');

        // Format tanggal_foto
        $tanggal_foto = null;
        if ($request->tanggal_foto) {
            $tanggal_foto = Carbon::parse($request->tanggal_foto)->format('Y-m-d');
        }

        $kategori = Kategori::firstOrCreate([
            'nama' => 'Galeri',
        ], [
            'slug' => 'galeri',
            'deskripsi' => 'Kategori unggulan untuk galeri foto',
        ]);

        // Simpan ke database
        Galeri::create([
            'judul' => $request->judul,
            'slug' => $this->generateSlug($request->judul),
            'kategori' => 'Galeri',
            'kategori_id' => $kategori->id,
            'deskripsi' => $request->deskripsi,
            'gambar' => $path,
            'url_gambar' => $path,
            'lokasi' => $request->lokasi,
            'tanggal_foto' => $tanggal_foto,
            'status' => $request->has('status') ? 1 : 0,
            'views' => 0,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan');
    }

    public function show($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.show', compact('galeri'));
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg',
            'lokasi' => 'nullable|string',
            'tanggal_foto' => 'nullable|date',
            'status' => 'nullable|boolean'
        ]);

        // Format tanggal_foto
        $tanggal_foto = null;
        if ($request->tanggal_foto) {
            $tanggal_foto = Carbon::parse($request->tanggal_foto)->format('Y-m-d');
        }

        $kategori = Kategori::firstOrCreate([
            'nama' => $galeri->kategori ?? 'Galeri',
        ], [
            'slug' => Str::slug($galeri->kategori ?? 'Galeri'),
            'deskripsi' => 'Kategori unggulan untuk galeri foto',
        ]);

        $data = [
            'judul' => $request->judul,
            'slug' => $this->generateSlug($request->judul, $galeri->id),
            'kategori' => $galeri->kategori ?? 'Galeri',
            'kategori_id' => $kategori->id,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'tanggal_foto' => $tanggal_foto,
            'status' => $request->has('status') ? 1 : 0,
        ];

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($galeri->gambar && Storage::exists($galeri->gambar)) {
                Storage::delete($galeri->gambar);
            }

            // Upload gambar baru
            $gambar = $request->file('gambar');
            $folder = 'image/galeri';
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs($folder, $filename, 'public');
            $data['gambar'] = $path;
            $data['url_gambar'] = $path;
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diupdate');
    }

    private function generateSlug(string $judul, ?int $ignoreId = null): string
    {
        $slug = Str::slug($judul);
        $query = Galeri::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '<>', $ignoreId);
        }

        if ($query->exists()) {
            $slug = $slug . '-' . time();
        }

        return $slug;
    }

    public function toggleStatus($id)
    {
        $galeri = Galeri::findOrFail($id);
        $galeri->status = !$galeri->status;
        $galeri->save();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Status galeri berhasil diperbarui');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        
        // Hapus file gambar
        if ($galeri->gambar && Storage::exists($galeri->gambar)) {
            Storage::delete($galeri->gambar);
        }
        
        $galeri->delete();

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil dihapus');
    }
}