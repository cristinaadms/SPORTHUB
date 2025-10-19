<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Remover coluna 'senha' da tabela users
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('senha');
        });

        // Adicionar coluna 'descricao' na tabela partidas
        Schema::table('partidas', function (Blueprint $table) {
            $table->text('descricao')->nullable()->after('nome'); // "after" é opcional
        });
    }

    public function down(): void
    {
        // Restaurar coluna 'password' em users
        Schema::table('users', function (Blueprint $table) {
            $table->string('senha');
        });

        // Remover coluna 'descricao' de partidas
        Schema::table('partidas', function (Blueprint $table) {
            $table->dropColumn('descricao');
        });
    }
};
