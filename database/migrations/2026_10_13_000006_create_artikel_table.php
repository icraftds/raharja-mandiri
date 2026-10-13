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
        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('kategori');
            $table->text('ringkasan')->nullable();
            $table->longText('konten');
            $table->string('gambar_sampul')->nullable();
            $table->text('kutipan')->nullable();
            $table->string('penulis_kutipan')->nullable();
            $table->json('gambar_tambahan')->nullable();
            $table->string('status')->default('published'); // 'published', 'draft'
            $table->boolean('unggulan')->default(false);
            $table->unsignedBigInteger('jumlah_pembaca')->default(0);
            $table->date('tanggal_publikasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};
