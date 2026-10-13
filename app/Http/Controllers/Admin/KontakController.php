<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class KontakController extends Controller
{
    /**
     * Tampilkan formulir pengaturan kontak.
     */
    public function index(): Response
    {
        $contactData = [
            'address' => Pengaturan::ambil('kontak_alamat', 'Tanjungsari, Sumedang'),
            'phone' => Pengaturan::ambil('kontak_telepon', '+62 813-2210-1618'),
            'email' => Pengaturan::ambil('kontak_email', 'psrm@raharjamandiri.org'),
            'mapsUrl' => Pengaturan::ambil('kontak_maps_url', 'https://maps.google.com/?q=Tanjungsari+Sumedang'),
            'instagram' => Pengaturan::ambil('kontak_instagram', '@psrm_raharja_mandiri'),
        ];

        return Inertia::render('admin/Kontak', [
            'contactData' => $contactData,
        ]);
    }

    /**
     * Simpan pembaruan informasi kontak publik.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:100'],
            'mapsUrl' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string', 'max:100'],
        ], [
            'address.required' => 'Alamat lengkap yayasan wajib diisi.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
        ]);

        Pengaturan::atur('kontak_alamat', $validated['address'], 'kontak');
        Pengaturan::atur('kontak_telepon', $validated['phone'], 'kontak');
        Pengaturan::atur('kontak_email', $validated['email'], 'kontak');
        Pengaturan::atur('kontak_maps_url', $validated['mapsUrl'] ?? '', 'kontak');
        Pengaturan::atur('kontak_instagram', $validated['instagram'] ?? '', 'kontak');

        // Perbarui juga nomor whatsapp floating jika ada perubahan format
        $cleanPhone = preg_replace('/[^0-9]/', '', $validated['phone']);
        if ($cleanPhone) {
            Pengaturan::atur('whatsapp_nomor', $cleanPhone, 'kontak');
        }

        return back()->with('success', 'Data kontak publik berhasil diperbarui!');
    }
}
