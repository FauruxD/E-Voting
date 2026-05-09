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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('npm', 30)->unique();
            $table->string('nama');
            $table->string('jurusan')->nullable();
            $table->string('prodi')->nullable();
            $table->string('pin');
            $table->enum('peran', ['voter', 'admin'])->default('voter');
            $table->boolean('sudah_memilih')->default(false);
            $table->boolean('aktif')->default(true);
            $table->rememberToken();
            $table->timestamps();

            $table->index('peran');
            $table->index('sudah_memilih');
            $table->index('aktif');
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
