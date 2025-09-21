<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('partida_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partida_id')->constrained('partidas')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['confirmado', 'recusado', 'pendente'])->default('pendente');
            $table->timestamps();
            
            $table->unique(['partida_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('partida_user');
    }
};