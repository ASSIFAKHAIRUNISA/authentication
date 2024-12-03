<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan nilai 'internal_reviewer' ke enum level
            $table->enum('level', ['admin', 'user', 'internal_reviewer'])->default('user')->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan enum tanpa 'internal_reviewer'
            $table->enum('level', ['admin', 'user'])->default('user')->change();
        });
    }
};
