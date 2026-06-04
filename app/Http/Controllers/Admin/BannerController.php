<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('urutan')->get();
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif',
            'link' => 'nullable|url',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $gambarPath = $request->file('gambar')->store('banner', 'public');

        Banner::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambarPath,
            'link' => $request->link,
            'urutan' => $request->urutan ?? 0,
            'status' => $request->status ?? true,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'link' => 'nullable|url',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
            'urutan' => $request->urutan ?? 0,
            'status' => $request->status ?? true,
        ];

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($banner->gambar && Storage::exists($banner->gambar)) {
                Storage::delete($banner->gambar);
            }

            $gambarPath = $request->file('gambar')->store('banner', 'public');
            $data['gambar'] = $gambarPath;
        }

        $banner->update($data);

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        // Hapus gambar dari storage
        if ($banner->gambar && Storage::exists($banner->gambar)) {
            Storage::delete($banner->gambar);
        }

        $banner->delete();

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil dihapus');
    }
}
