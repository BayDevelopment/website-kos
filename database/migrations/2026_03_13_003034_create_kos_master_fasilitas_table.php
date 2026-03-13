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
        Schema::create('kos_master_fasilitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kos_id')->constrained('kos')->cascadeOnDelete();
            $table->foreignId('master_fasilitas_id')->constrained('master_fasilitas')->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['kos_id', 'master_fasilitas_id'], 'kos_master_fasilitas_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kos_master_fasilitas');
    }
};
