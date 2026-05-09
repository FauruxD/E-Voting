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
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
            $table->timestamp('voted_at')->useCurrent();
            $table->timestamps();

            $table->index('candidate_id');
            $table->index('voted_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
