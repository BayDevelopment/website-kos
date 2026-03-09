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
        Schema::create('identitas_mahasiswas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')           // asumsi table users
                ->cascadeOnDelete();

            $table->string('nama_lengkap');
            $table->string('asal_universitas');
            $table->unsignedTinyInteger('semester');
            $table->string('nik', 20)->unique();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('asal_kota');
            $table->text('alamat');
            $table->string('no_wa', 20);

            $table->string('avatar')->nullable();   // boleh null karena gambar

            $table->boolean('is_complete')->default(false);

            // kolom verifikasi
            $table->enum('verification_status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->text('verification_note')->nullable();

            $table->timestamp('verified_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identitas_mahasiswas');
    }
};
