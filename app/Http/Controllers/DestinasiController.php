<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destinasi;
use App\Models\Galeri;
use App\Models\Umkm;
use App\Models\Akomodasi;
use App\Models\Transportasi;

class DestinasiController extends Controller
{
    public function index()
    {
        $destinasi = Destinasi::where('status', true)->get();
        return view('destinasi.index', compact('destinasi'));
    }

    public function show($id)
    {
        $destinasi = Destinasi::where('status', true)->findOrFail($id);

        // Dynamic galeri: prefer galeri items where lokasi matches destinasi lokasi or kategori
            $galeriQuery = Galeri::where('status', true);
            if ($destinasi->lokasi) {
                $galeriQuery->where('lokasi', 'like', '%' . $destinasi->lokasi . '%');
            } else {
                $galeriQuery->where('kategori', $destinasi->kategori ?? '');
            }
            $galeri = $galeriQuery->latest()->take(9)->get()->map(function ($g) {
                return $g->gambar_url ?? $g->gambar;
            })->toArray();

        // UMKM related by lokasi
            $umkms = $destinasi->umkms()->latest()->take(6)->get();
            if ($umkms->isEmpty() && $destinasi->lokasi) {
                $umkms = Umkm::where('lokasi', 'like', '%' . $destinasi->lokasi . '%')
                    ->latest()->take(6)->get();
            }

        // Akomodasi and Transportasi (may be empty if none exist)
            $akomodasis = $destinasi->akomodasis()->where('status', true)->latest()->take(6)->get();
            if ($akomodasis->isEmpty() && $destinasi->lokasi) {
                $akomodasis = Akomodasi::where('status', true)
                    ->where('lokasi', 'like', '%' . $destinasi->lokasi . '%')
                    ->latest()->take(6)->get();
            }

        // Transportasi: Get from relationship (destinasi_id) or by lokasi
        $transportasis = $destinasi->transportasis()->where('status', true)->latest()->take(6)->get();
        if ($transportasis->isEmpty() && $destinasi->lokasi) {
            $transportasis = Transportasi::where('status', true)
                ->where('lokasi', 'like', '%' . $destinasi->lokasi . '%')
                ->latest()->take(6)->get();
        }

        // Embed maps
        $destinasi->embed_maps = $destinasi->maps ? 'https://www.google.com/maps?q=' . urlencode($destinasi->lokasi) . '&output=embed' : null;

        return view('destinasi.detail', compact('destinasi', 'galeri', 'umkms', 'akomodasis', 'transportasis'));
    }

    // ===================== ALAM =====================
    public function alam()
    {
        $kategori = 'Alam';
        $deskripsi = 'Destinasi wisata alam yang menampilkan keindahan geologi, pegunungan, air terjun, dan keunikan alam Danau Toba.';
        $destinasi = Destinasi::where('kategori', 'Alam')
            ->where('status', true)
            ->latest()
            ->paginate(12);

        return view('destinasi.kategori', compact('kategori', 'deskripsi', 'destinasi'));
    }

    // ===================== BUATAN =====================
    public function buatan()
    {
        $kategori = 'Buatan';
        $deskripsi = 'Destinasi wisata buatan manusia di kawasan Danau Toba.';
        $destinasi = Destinasi::where('kategori', 'Buatan')
            ->where('status', true)
            ->latest()
            ->paginate(12);

        return view('destinasi.kategori', compact('kategori', 'deskripsi', 'destinasi'));
    }

    // ===================== BUDAYA =====================
    public function budaya()
    {
        $kategori = 'Budaya';
        $deskripsi = 'Wisata budaya Batak Toba.';
        $destinasi = Destinasi::where('kategori', 'Budaya')
            ->where('status', true)
            ->latest()
            ->paginate(12);

        return view('destinasi.kategori', compact('kategori', 'deskripsi', 'destinasi'));
    }
}
