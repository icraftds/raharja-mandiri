<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\KebutuhanDonasi;
use App\Models\Rekening;
use Inertia\Inertia;
use Inertia\Response;

class DonasiController extends Controller
{
    /**
     * Tampilkan halaman rekening donasi resmi yayasan.
     */
    public function accounts(): Response
    {
        $banks = Rekening::where('aktif', true)
            ->orderBy('urutan')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->nama_bank,
                    'account' => $item->nomor_rekening,
                    'holder' => $item->atas_nama,
                    'textColor' => $item->warna_teks ?? 'text-teal-600',
                    'bgColor' => $item->warna_latar ?? 'bg-teal-600',
                    'lightBg' => $item->warna_latar_muda ?? 'bg-teal-50',
                ];
            });

        return Inertia::render('Donasi/Rekening', [
            'banks' => $banks,
        ]);
    }

    /**
     * Tampilkan daftar kebutuhan logistik/barang fisik yayasan.
     */
    public function needs(): Response
    {
        $items = KebutuhanDonasi::where('aktif', true)
            ->orderBy('urutan')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->nama_barang,
                    'desc' => $item->deskripsi,
                    'qty' => $item->target_jumlah,
                    'status' => $item->urgensi,
                    'color' => $item->warna_teks ?? 'text-pink-600',
                    'bgColor' => $item->warna_latar ?? 'bg-pink-600',
                    'lightBg' => $item->warna_latar_muda ?? 'bg-pink-50',
                ];
            });

        return Inertia::render('Donasi/Kebutuhan', [
            'items' => $items,
        ]);
    }
}
