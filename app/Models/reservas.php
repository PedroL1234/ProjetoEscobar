<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservas extends Model
{
    use HasFactory;
    public function up()
    {
        if (!Schema::hasTable('reservas')) {
            Schema::create('reservas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('fk_pro_id')->constrained();
                $table->foreignId('fk_cli_id')->constrained();
                $table->foreignId('fk_est_id')->constrained();
                $table->timestamps();
            });
        }   
    }

    protected $table = 'reservas';
     

    protected $fillable = [
        'fk_pro_id',  // Promoção
        'fk_cli_id',  // Cliente
        'fk_est_id'   // Estoque (Produto)
    ];

    // Relacionamento com Cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'fk_cli_id');
    }

    // Relacionamento com Estoque (Produto)
    public function estoque()
    {
        return $this->belongsTo(Estoque::class, 'fk_est_id');
    }

    // Relacionamento com Promoção
    public function promocao()
    {
        return $this->belongsTo(Promocao::class, 'fk_pro_id');
    }
}
