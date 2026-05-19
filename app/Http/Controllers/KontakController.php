<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Display the kontak page
     */
    public function index()
    {
        // Ambil data kontak pertama (atau buat default jika tidak ada)
        $kontak = Kontak::first() ?? new Kontak();
        
        return view('pages.kontak', compact('kontak'));
    }

    /**
     * Store contact form submission
     */
    public function storeMessage(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'subjek' => 'required|string|max:255',
            'pesan' => 'required|string'
        ]);

        // Simpan pesan ke database atau kirim email
        // Untuk sekarang, kita bisa simpan ke file log atau database
        \Log::info('Pesan kontak dari: ' . $validated['nama'], $validated);

        return redirect()->route('kontak')->with('success', 'Pesan Anda telah dikirim!');
    }
}
