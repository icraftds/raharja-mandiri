<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kebutuhan_donasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->text('deskripsi')->nullable();
            $table->string('target_jumlah');
            $table->string('urgensi')->default('Mendesak'); // Mendesak, Rutin, Terpenuhi
            $table->string('warna_teks')->nullable()->default('text-pink-600');
            $table->string('warna_latar')->nullable()->default('bg-pink-600');
            $table->string('warna_latar_muda')->nullable()->default('bg-pink-50');
            $table->boolean('aktif')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebutuhan_donasi');
    }
};
