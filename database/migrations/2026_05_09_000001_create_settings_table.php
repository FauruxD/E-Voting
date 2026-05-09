<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_aplikasi')->default('BEM E-Voting');
            $table->string('judul_pemilihan')->default('Pemilihan Umum BEM 2026');
            $table->enum('status_voting', ['open', 'closed'])->default('closed');
            $table->boolean('hasil_ditampilkan')->default(false);
            $table->dateTime('mulai_voting')->nullable();
            $table->dateTime('selesai_voting')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
