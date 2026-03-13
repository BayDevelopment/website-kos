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
        Schema::create('kos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('nama_kos');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();

            $table->enum('tipe_kos', ['putra', 'putri', 'campur']);
            $table->enum('jenis_sewa', ['harian', 'bulanan', 'tahunan'])->default('bulanan');

            $table->decimal('harga_mulai', 12, 2)->nullable();

            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kelurahan')->nullable();
            $table->text('alamat_lengkap');
            $table->string('kode_pos', 10)->nullable();

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->string('kontak_nama')->nullable();
            $table->string('kontak_wa', 20)->nullable();

            $table->boolean('is_active')->default(true);
            $table->enum('status', ['draft', 'pending', 'published', 'rejected', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};
