<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::with('kategori')->latest()->paginate(10);
        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.berita.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg',
            'kategori_id' => 'required',
            'tanggal_terbit' => 'required',
        ]);

        // Upload gambar ke storage
        $gambar = $request->file('gambar');
        $filename = time() . '_' . Str::slug($request->judul) . '.' . $gambar->getClientOriginalExtension();
        $path = $gambar->storeAs('berita', $filename, 'public');
        $gambarPath = str_replace('public/', 'storage/', $path);

        Berita::create([
            'judul' => $request->judul,
            'slug' => $this->generateSlug($request->judul),
            'konten' => $request->konten,
            'gambar' => $gambarPath,
            'kategori_id' => $request->kategori_id,
            'penulis' => $request->penulis ?? 'Admin',
            'tanggal_terbit' => $request->tanggal_terbit,
            'status' => $request->has('status'),
            'views' => 0,
            'komentar' => 0,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.berita.edit', compact('berita', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'kategori_id' => 'required',
            'tanggal_terbit' => 'required',
        ]);

        $data = [
            'judul' => $request->judul,
            'slug' => $this->generateSlug($request->judul, $berita->id),
            'konten' => $request->konten,
            'kategori_id' => $request->kategori_id,
            'penulis' => $request->penulis ?? 'Admin',
            'tanggal_terbit' => $request->tanggal_terbit,
            'status' => $request->has('status'),
        ];

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            $oldPath = str_replace('storage/', 'public/', $berita->gambar);
            if (Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }

            // Upload gambar baru
            $gambar = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs('berita', $filename, 'public');
            $data['gambar'] = str_replace('public/', 'storage/', $path);
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diupdate!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        // Hapus file gambar
        $gambarPath = str_replace('storage/', 'public/', $berita->gambar);
        if (Storage::exists($gambarPath)) {
            Storage::delete($gambarPath);
        }
        
        $berita->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }

    private function generateSlug(string $judul, ?int $ignoreId = null): string
    {
        $slug = Str::slug($judul);
        $query = Berita::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '<>', $ignoreId);
        }

        if ($query->exists()) {
            $slug = $slug . '-' . time();
        }

        return $slug;
    }
}