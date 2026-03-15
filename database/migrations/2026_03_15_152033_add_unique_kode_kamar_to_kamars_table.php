<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('kamars', function (Blueprint $table) {
            $table->unique(['kos_id', 'kode_kamar']);
        });
    }

    public function down()
    {
        Schema::table('kamars', function (Blueprint $table) {
            $table->dropUnique(['kos_id', 'kode_kamar']);
        });
    }
};
