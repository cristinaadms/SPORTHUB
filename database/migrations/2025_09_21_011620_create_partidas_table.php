<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->integer('quantPessoas');
            $table->integer('quantEspera');
            $table->float('valor');
            $table->enum('modalidade', ['basquete', 'futsal', 'volei', 'beach_tenis']);
            $table->enum('tipo', ['publica', 'privada'])->default('publica');
            
            // Relacionamentos
            $table->foreignId('criador_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('local_id')->constrained('locais')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('partidas');
    }
};