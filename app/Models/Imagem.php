<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Importação do trait

class Imagem extends Model
{
    use HasFactory; 
    protected $table = 'imagem';
    
    protected $fillable = ['caminho']; 

    public function estoque()
    {
        return $this->hasMany(estoque::class, 'fk_img_id');
    }
}
