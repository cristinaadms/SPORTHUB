<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conteudo',
        'user_id',
        'partida_id',
    ];

    public function partida()
    {
        return $this->belongsTo(Partida::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
