<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        // Atualiza valores existentes
        DB::table('avaliacoes')
            ->where('tipo', 'partida')
            ->update(['tipo' => 'usuario']);

        // Remove a constraint CHECK antiga
        DB::statement('ALTER TABLE avaliacoes DROP CONSTRAINT avaliacoes_tipo_check');

        // Adiciona a nova constraint CHECK
        DB::statement("ALTER TABLE avaliacoes ADD CONSTRAINT avaliacoes_tipo_check CHECK (tipo IN ('usuario', 'local'))");
    }

    public function down()
    {
        // Reverte valores
        DB::table('avaliacoes')
            ->where('tipo', 'usuario')
            ->update(['tipo' => 'partida']);

        // Remove a constraint nova
        DB::statement('ALTER TABLE avaliacoes DROP CONSTRAINT avaliacoes_tipo_check');

        // Recria a antiga constraint
        DB::statement("ALTER TABLE avaliacoes ADD CONSTRAINT avaliacoes_tipo_check CHECK (tipo IN ('partida', 'local'))");
    }
};
