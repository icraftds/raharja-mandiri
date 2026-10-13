<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UnggahBerkas
{
    /**
     * Unggah berkas gambar ke storage public.
     *
     * @param UploadedFile $berkas
     * @param string $folder
     * @param string|null $berkasLama
     * @return string
     */
    public static function simpan(UploadedFile $berkas, string $folder = 'gambar', ?string $berkasLama = null): string
    {
        // Hapus berkas lama jika ada di storage public
        if ($berkasLama) {
            static::hapus($berkasLama);
        }

        $namaBerkas = Str::random(24) . '.' . $berkas->getClientOriginalExtension();
        $path = $berkas->storeAs("uploads/{$folder}", $namaBerkas, 'public');

        return Storage::url($path);
    }

    /**
     * Hapus berkas dari storage public.
     *
     * @param string|null $urlBerkas
     * @return bool
     */
    public static function hapus(?string $urlBerkas): bool
    {
        if (!$urlBerkas) {
            return false;
        }

        // Hanya hapus jika berkas berada di /storage/uploads/
        if (Str::startsWith($urlBerkas, '/storage/')) {
            $path = Str::after($urlBerkas, '/storage/');
            if (Storage::disk('public')->exists($path)) {
                return Storage::disk('public')->delete($path);
            }
        }

        return false;
    }
}
