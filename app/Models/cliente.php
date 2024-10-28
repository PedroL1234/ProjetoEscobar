<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

   
    protected $fillable = [
        'cli_nome',
        'cli_email',
        'cli_numero',
    ];

    
    public $timestamps = true;
}
