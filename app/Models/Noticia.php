<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $table = "noticias";

    protected $fillable = [
        'titulo',
        'subtitulo',
        'corpo',
        'imagem_nome',
        'imagem_extensao',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
