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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kos_id')->constrained('kos')->cascadeOnDelete();

            $table->string('nama_kamar');
            $table->string('kode_kamar');

            $table->decimal('harga', 12, 2);
            $table->decimal('deposit', 12, 2)->nullable();

            $table->integer('luas')->nullable()->comment('dalam meter persegi');
            $table->integer('stok')->default(1);

            $table->boolean('tersedia')->default(true);
            $table->text('deskripsi')->nullable();

            $table->timestamps();

            // // proteksi kode kamar dalam 1 kos
            // $table->unique(['kos_id', 'kode_kamar']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
