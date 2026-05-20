<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\Berita;
use App\Models\Banner;
use App\Models\Destinasi;
use App\Models\Umkm;
use App\Models\Informasi;

class HomeController extends Controller
{
    public function index()
    {
        $galeri = Galeri::where('status', true)->latest()->take(6)->get();
        $berita = Berita::with('kategori')->where('status', true)->latest()->take(3)->get();
        $banners = Banner::where('status', true)->orderBy('urutan')->get();
        $destinasi = Destinasi::where('status', true)->latest()->take(4)->get();

        return view('pages.home', compact('galeri', 'berita', 'destinasi', 'banners'));
    }

    public function umkm()
    {
        $umkms = Umkm::all();
        return view('pages.umkm', compact('umkms'));
    }

    public function budaya()
    {
        $budayaItems = Informasi::where('status', true)->where('kategori', 'Budaya')->latest()->get();
        return view('pages.budaya', compact('budayaItems'));
    }
}