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
        Schema::create('pengunjung_website', function (Blueprint $table) {
            $table->id();
            $table->string('alamat_ip', 45)->nullable()->index();
            $table->string('halaman')->index();
            $table->string('judul_halaman')->nullable();
            $table->string('perangkat', 50)->default('Desktop')->index(); // Desktop, Mobile, Tablet
            $table->string('browser', 50)->default('Lainnya')->index();
            $table->string('sistem_operasi', 50)->default('Lainnya')->index();
            $table->string('perujuk')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengunjung_website');
    }
};
