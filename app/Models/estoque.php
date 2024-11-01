<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estoque extends Model
{
    use HasFactory;
    protected $table = 'estoque';
    
    protected $fillable = [
        'est_tamanho',
        'est_nome',
        'est_valor',
        'est_descricao',
        'est_quantia',
        'fk_img_id',
    ];
    public function imagem()
    {
        return $this->belongsTo(Imagem::class, 'fk_img_id');
    }

    public $timestamps = false;
    
}
