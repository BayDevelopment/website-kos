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
        Schema::create('kamar_master_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kamar_id')->constrained('kamars')->cascadeOnDelete();
            $table->foreignId('master_fasilitas_id')->constrained('master_fasilitas')->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['kamar_id', 'master_fasilitas_id'], 'kamar_master_fasilitas_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar_master_fasilitas');
    }
};
