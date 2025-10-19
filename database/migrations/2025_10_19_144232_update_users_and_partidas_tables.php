<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Adicionar coluna 'descricao' na tabela partidas
        Schema::table('partidas', function (Blueprint $table) {
            $table->text('descricao')->nullable()->after('nome'); // "after" é opcional
        });

        Schema::table('partidas', function (Blueprint $table) {
            $table->text('nome')->after('id'); // "after" é opcional
        });
    }

    public function down(): void
    {
        // Remover coluna 'descricao' de partidas
        Schema::table('partidas', function (Blueprint $table) {
            $table->dropColumn('descricao');
        });

        // Remover coluna 'descricao' de partidas
        Schema::table('partidas', function (Blueprint $table) {
            $table->dropColumn('nome');
        });
    }
};
