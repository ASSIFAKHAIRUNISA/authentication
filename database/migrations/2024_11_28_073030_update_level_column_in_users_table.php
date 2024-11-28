<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('level')->default('user')->change(); // Ubah tipe kolom menjadi string
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('level', ['admin', 'user'])->default('user')->change(); // Kembalikan ke enum
        });
    }
};
