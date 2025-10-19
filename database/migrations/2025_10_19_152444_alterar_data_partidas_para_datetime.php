<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('partidas', function (Blueprint $table) {
            $table->dateTime('data')->change(); // Alterar para datetime
        });
    }

    public function down(): void
    {
        Schema::table('partidas', function (Blueprint $table) {
            $table->date('data')->change(); // Reverter para date
        });
    }
};
