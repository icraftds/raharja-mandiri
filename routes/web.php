<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Hero')->name('home');
Route::inertia('/tentang/visi-misi', 'Tentang/VisiMisi')->name('tentang.visi-misi');
Route::inertia('/tentang/sejarah', 'Tentang/Sejarah')->name('tentang.sejarah');
Route::inertia('/tentang/kepengurusan', 'Tentang/Kepengurusan')->name('tentang.kepengurusan');
Route::inertia('/galeri', 'Galeri')->name('galeri');
Route::inertia('/artikel', 'Artikel')->name('artikel');
Route::inertia('/donasi/rekening', 'Donasi/Rekening')->name('donasi.rekening');
Route::inertia('/donasi/kebutuhan', 'Donasi/Kebutuhan')->name('donasi.kebutuhan');
Route::inertia('/kontak', 'Kontak')->name('kontak');
