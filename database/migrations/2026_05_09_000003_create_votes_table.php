<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemilih_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->foreignId('kandidat_id')->constrained('candidates')->cascadeOnDelete();
            $table->timestamp('dipilih_pada')->useCurrent();
            $table->timestamps();

            $table->index('pemilih_id');
            $table->index('kandidat_id');
            $table->index('dipilih_pada');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
