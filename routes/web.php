<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Hero')->name('home');
Route::inertia('/tentang/visi-misi', 'Tentang/VisiMisi')->name('tentang.visi-misi');
Route::inertia('/tentang/sejarah', 'Tentang/Sejarah')->name('tentang.sejarah');
Route::inertia('/tentang/kepengurusan', 'Tentang/Kepengurusan')->name('tentang.kepengurusan');
Route::inertia('/galeri', 'Galeri')->name('galeri');
Route::inertia('/artikel', 'Artikel')->name('artikel');
Route::inertia('/artikel/baca', 'BacaArtikel')->name('artikel.baca');
Route::inertia('/donasi/rekening', 'Donasi/Rekening')->name('donasi.rekening');
Route::inertia('/donasi/kebutuhan', 'Donasi/Kebutuhan')->name('donasi.kebutuhan');
Route::inertia('/kontak', 'Kontak')->name('kontak');

// Admin CMS Routes
Route::redirect('/admin', '/admin/login');
Route::inertia('/admin/login', 'admin/Login')->name('admin.login');
Route::inertia('/admin/dashboard', 'admin/Dashboard')->name('admin.dashboard');
Route::inertia('/admin/sejarah', 'admin/Sejarah')->name('admin.sejarah');
Route::inertia('/admin/visi-misi', 'admin/VisiMisi')->name('admin.visi-misi');
Route::inertia('/admin/kepengurusan', 'admin/Kepengurusan')->name('admin.kepengurusan');
Route::inertia('/admin/galeri', 'admin/Galeri')->name('admin.galeri');
Route::inertia('/admin/artikel', 'admin/Artikel')->name('admin.artikel');
Route::inertia('/admin/artikel/edit', 'admin/DetailArtikel')->name('admin.artikel.edit');
Route::inertia('/admin/rekening', 'admin/Rekening')->name('admin.rekening');
Route::inertia('/admin/kontak', 'admin/Kontak')->name('admin.kontak');
