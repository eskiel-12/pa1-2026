<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InformasiController extends Controller
{
    public function index()
    {
        $informasi = Informasi::latest()->paginate(10);
        return view('admin.informasi.index', compact('informasi'));
    }

    public function create()
    {
        return view('admin.informasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'kategori' => 'required',
        ]);

        $data = [
            'judul' => $request->judul,
            'slug' => $this->generateSlug($request->judul),
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            'penulis' => $request->penulis ?? 'Admin',
            'status' => $request->has('status'),
            'views' => 0,
        ];

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs('informasi', $filename, 'public');
            $data['gambar'] = str_replace('public/', 'storage/', $path);
        }

        Informasi::create($data);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $informasi = Informasi::findOrFail($id);
        return view('admin.informasi.edit', compact('informasi'));
    }

    public function update(Request $request, $id)
    {
        $informasi = Informasi::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'kategori' => 'required',
        ]);

        $data = [
            'judul' => $request->judul,
            'slug' => $this->generateSlug($request->judul, $informasi->id),
            'konten' => $request->konten,
            'kategori' => $request->kategori,
            'penulis' => $request->penulis ?? 'Admin',
            'status' => $request->has('status'),
        ];

        if ($request->hasFile('gambar')) {
            if ($informasi->gambar) {
                $oldPath = str_replace('storage/', 'public/', $informasi->gambar);
                if (Storage::exists($oldPath)) {
                    Storage::delete($oldPath);
                }
            }
            $gambar = $request->file('gambar');
            $filename = time() . '_' . Str::slug($request->judul) . '.' . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs('informasi', $filename, 'public');
            $data['gambar'] = str_replace('public/', 'storage/', $path);
        }

        $informasi->update($data);

        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $informasi = Informasi::findOrFail($id);
        if ($informasi->gambar) {
            $gambarPath = str_replace('storage/', 'public/', $informasi->gambar);
            if (Storage::exists($gambarPath)) {
                Storage::delete($gambarPath);
            }
        }
        $informasi->delete();
        return redirect()->route('admin.informasi.index')->with('success', 'Informasi berhasil dihapus!');
    }

    private function generateSlug(string $judul, ?int $ignoreId = null): string
    {
        $slug = Str::slug($judul);
        $query = Informasi::where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '<>', $ignoreId);
        }

        if ($query->exists()) {
            $slug = $slug . '-' . time();
        }

        return $slug;
    }
}