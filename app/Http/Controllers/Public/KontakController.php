<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Models\PesanKontak;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class KontakController extends Controller
{
    /**
     * Tampilkan halaman kontak yayasan.
     */
    public function index(): Response
    {
        $contact = [
            'address' => Pengaturan::ambil('kontak_alamat', 'Tanjungsari, Kabupaten Sumedang, Jawa Barat, 45362'),
            'phone' => Pengaturan::ambil('kontak_telepon', '+62 813-2210-1618'),
            'email' => Pengaturan::ambil('kontak_email', 'psrm@raharjamandiri.org'),
            'operationalHours' => Pengaturan::ambil('kontak_jam_kerja', 'Senin - Minggu (08:00 - 17:00)'),
            'instagram' => Pengaturan::ambil('kontak_instagram', '@psrm_raharja_mandiri'),
            'instagramUrl' => Pengaturan::ambil('kontak_instagram_url', 'https://www.instagram.com/psrm_raharja_mandiri/'),
            'mapsUrl' => Pengaturan::ambil('kontak_maps_url', 'https://maps.google.com/?q=Tanjungsari+Sumedang'),
        ];

        return Inertia::render('Kontak', [
            'contact' => $contact,
        ]);
    }

    /**
     * Simpan pesan dari pengunjung formulir kontak.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kontak' => ['required', 'string', 'max:255'],
            'pesan' => ['required', 'string'],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'kontak.required' => 'Email atau nomor telepon/WA wajib diisi.',
            'pesan.required' => 'Pesan Anda wajib ditulis.',
        ]);

        PesanKontak::create([
            'nama' => $validated['nama'],
            'kontak' => $validated['kontak'],
            'pesan' => $validated['pesan'],
            'sudah_dibaca' => false,
        ]);

        return back()->with('success', 'Pesan Anda berhasil dikirim! Pengurus yayasan akan segera menghubungi Anda.');
    }
}
