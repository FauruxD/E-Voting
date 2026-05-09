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
            $table->integer('serial_number')->unique();
            $table->string('chairman_name');
            $table->string('vice_name');
            $table->string('faculty')->nullable();
            $table->string('major')->nullable();
            $table->string('batch', 50)->nullable();
            $table->text('vision');
            $table->longText('mission');
            $table->json('work_programs')->nullable();
            $table->string('photo')->nullable();
            $table->enum('status', ['verified', 'pending'])->default('pending');
            $table->timestamps();

            $table->index('status');
            $table->index('serial_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
