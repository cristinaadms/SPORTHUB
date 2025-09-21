<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->id();
            $table->float('estrelas'); // 1 a 5
            $table->text('feedback')->nullable();
            $table->enum('tipo', ['usuario', 'local']);
            
            // Relacionamentos
            $table->foreignId('avaliador_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('partida_id')->constrained('partidas')->onDelete('cascade');
            $table->foreignId('avaliado_id')->nullable()->constrained('users')->onDelete('cascade'); // Para avaliação de usuário
            $table->foreignId('local_id')->nullable()->constrained('locais')->onDelete('cascade'); // Para avaliação de local
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('avaliacoes');
    }
};