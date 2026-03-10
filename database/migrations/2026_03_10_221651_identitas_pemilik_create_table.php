<?php

use Filament\Schemas\Commands\FileGenerators\SchemaClassGenerator;
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
        Schema::create('identitas_pemilik', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->string('nama_lengkap');

            $table->string('nik', 20)->unique();

            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']); // required

            $table->text('alamat');

            $table->string('no_wa', 20);

            $table->string('avatar')->nullable();

            $table->string('foto_ktp'); // required
            $table->string('foto_selfie'); // required

            $table->string('nama_usaha'); // required

            $table->enum('status_pengelola', ['pemilik', 'pengelola', 'agen'])
                ->default('pemilik');

            $table->boolean('is_complete')->default(false);

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
        Schema::dropIfExists('identitas_pemilik');
    }
};
