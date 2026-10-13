<?php

namespace App\Http\Middleware;

use App\Models\PengunjungWebsite;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CatatPengunjungWebsite
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Hanya catat request GET pada halaman publik berstatus sukses (200)
        if ($request->isMethod('GET') && $response->getStatusCode() === 200) {
            $path = $request->path();

            // Kecualikan rute admin, login, assets, dan rute internal
            if (
                !$request->is('admin*') &&
                !$request->is('login*') &&
                !$request->is('logout*') &&
                !$request->is('up') &&
                !$request->is('build/*') &&
                !$request->is('assets/*') &&
                !$request->is('storage/*')
            ) {
                try {
                    $userAgent = $request->userAgent();
                    $infoUA = PengunjungWebsite::uraikanUserAgent($userAgent);

                    // Tentukan judul halaman sederhana berdasarkan path
                    $judul = 'Beranda';
                    if ($request->is('tentang/visi-misi')) $judul = 'Visi & Misi';
                    elseif ($request->is('tentang/sejarah')) $judul = 'Sejarah';
                    elseif ($request->is('tentang/kepengurusan')) $judul = 'Kepengurusan';
                    elseif ($request->is('galeri')) $judul = 'Galeri Kegiatan';
                    elseif ($request->is('artikel*')) $judul = 'Artikel & Berita';
                    elseif ($request->is('donasi/rekening')) $judul = 'Rekening Donasi';
                    elseif ($request->is('donasi/kebutuhan')) $judul = 'Kebutuhan Donasi';
                    elseif ($request->is('kontak')) $judul = 'Hubungi Kami';

                    PengunjungWebsite::create([
                        'alamat_ip' => $request->ip(),
                        'halaman' => '/' . ltrim($path, '/'),
                        'judul_halaman' => $judul,
                        'perangkat' => $infoUA['perangkat'],
                        'browser' => $infoUA['browser'],
                        'sistem_operasi' => $infoUA['sistem_operasi'],
                        'perujuk' => $request->headers->get('referer'),
                        'user_agent' => $userAgent,
                    ]);
                } catch (\Throwable $e) {
                    // Jangan ganggu respon pengguna jika ada error logging
                    report($e);
                }
            }
        }

        return $response;
    }
}
