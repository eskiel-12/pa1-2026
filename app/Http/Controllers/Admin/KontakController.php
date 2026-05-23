<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kontak;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KontakController extends Controller
{
    /**
     * Display a listing of the kontak.
     */
    public function index()
    {
        $kontak = Kontak::first() ?? new Kontak();
        return view('admin.kontak.index', compact('kontak'));
    }

    /**
     * Show the form for creating a new kontak.
     */
    public function create()
    {
        return view('admin.kontak.create');
    }

    /**
     * Store a newly created kontak in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat' => 'nullable|string|max:500',
            'telepon_1' => 'nullable|string|max:20',
            'telepon_2' => 'nullable|string|max:20',
            'telepon_3' => 'nullable|string|max:20',
            'email_1' => 'nullable|email|max:255',
            'email_2' => 'nullable|email|max:255',
            'email_3' => 'nullable|email|max:255',
            'jam_buka_kerja' => 'nullable|date_format:H:i',
            'jam_tutup_kerja' => 'nullable|date_format:H:i',
            'jam_buka_weekend' => 'nullable|date_format:H:i',
            'jam_tutup_weekend' => 'nullable|date_format:H:i',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'maps_url' => 'nullable|url|max:500',
        ]);

        $validated['user_id'] = auth()->id();
        Kontak::create($validated);

        return redirect()->route('admin.kontak.index')->with('success', 'Data kontak berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the kontak.
     */
    public function edit(Kontak $kontak)
    {
        return view('admin.kontak.edit', compact('kontak'));
    }

    /**
     * Update the kontak in storage.
     */
    public function update(Request $request, Kontak $kontak)
    {
        $validated = $request->validate([
            'alamat' => 'nullable|string|max:500',
            'telepon_1' => 'nullable|string|max:20',
            'telepon_2' => 'nullable|string|max:20',
            'telepon_3' => 'nullable|string|max:20',
            'email_1' => 'nullable|email|max:255',
            'email_2' => 'nullable|email|max:255',
            'email_3' => 'nullable|email|max:255',
            'jam_buka_kerja' => 'nullable|date_format:H:i',
            'jam_tutup_kerja' => 'nullable|date_format:H:i',
            'jam_buka_weekend' => 'nullable|date_format:H:i',
            'jam_tutup_weekend' => 'nullable|date_format:H:i',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',
            'maps_url' => 'nullable|url|max:500',
        ]);

        $kontak->update($validated);

        return redirect()->route('admin.kontak.index')->with('success', 'Data kontak berhasil diperbarui!');
    }

    /**
     * Remove the kontak from storage.
     */
    public function destroy(Kontak $kontak)
    {
        $kontak->delete();
        return redirect()->route('admin.kontak.index')->with('success', 'Data kontak berhasil dihapus!');
    }
}
