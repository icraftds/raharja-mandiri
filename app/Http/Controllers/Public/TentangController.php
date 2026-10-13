<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Misi;
use App\Models\Pengaturan;
use App\Models\Pengurus;
use App\Models\Sejarah;
use Inertia\Inertia;
use Inertia\Response;

class TentangController extends Controller
{
    /**
     * Tampilkan halaman Visi & Misi yayasan.
     */
    public function visiMisi(): Response
    {
        $visi = Pengaturan::ambil('visi_utama', 'Menjadi lembaga yang mencetak generasi Mandiri, Cerdas, & Berakhlak Mulia serta memberikan dampak nyata bagi masyarakat luas.');
        $misiList = Misi::orderBy('urutan')->get();

        return Inertia::render('Tentang/VisiMisi', [
            'visi' => $visi,
            'missions' => $misiList,
        ]);
    }

    /**
     * Tampilkan halaman linimasa Sejarah yayasan.
     */
    public function sejarah(): Response
    {
        $milestones = Sejarah::orderBy('urutan')->get();

        return Inertia::render('Tentang/Sejarah', [
            'milestones' => $milestones,
        ]);
    }

    /**
     * Tampilkan halaman Susunan Kepengurusan yayasan.
     */
    public function kepengurusan(): Response
    {
        $team = Pengurus::where('aktif', true)->orderBy('urutan')->get();

        return Inertia::render('Tentang/Kepengurusan', [
            'team' => $team,
        ]);
    }
}
