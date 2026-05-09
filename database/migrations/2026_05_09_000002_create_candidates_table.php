<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_urut')->unique();
            $table->string('nama_ketua');
            $table->string('nama_wakil');
            $table->string('jurusan')->nullable();
            $table->string('prodi')->nullable();
            $table->string('angkatan', 50)->nullable();
            $table->text('visi');
            $table->longText('misi');
            $table->json('program_kerja')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['verified', 'pending'])->default('pending');
            $table->timestamps();

            $table->index('status');
            $table->index('nomor_urut');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
