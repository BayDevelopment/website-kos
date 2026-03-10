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
        Schema::create('rekening_pemilik', function (Blueprint $table) {
            $table->id();

            $table->foreignId('identitas_pemilik_id')
                ->constrained('identitas_pemilik')
                ->cascadeOnDelete();

            $table->foreignId('rekening_id')
                ->constrained('tb_rekening')
                ->restrictOnDelete();

            $table->string('nomor_rekening', 50);
            $table->string('atas_nama');
            $table->boolean('is_primary')->default(true);
            $table->timestamp('verified_at')->nullable();
            $table->enum('verification_status', ['pending', 'approved', 'rejected'])
                ->default('pending');
            $table->timestamps();

            $table->unique(['identitas_pemilik_id', 'nomor_rekening'], 'uniq_pemilik_nomor_rekening');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekening_pemilik');
    }
};
