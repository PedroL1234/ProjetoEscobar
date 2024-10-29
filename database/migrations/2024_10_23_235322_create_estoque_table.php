<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('estoque', function (Blueprint $table) {
            $table->id();
            $table->string('est_tamanho');
            $table->string('est_descricao');
            $table->integer('est_quantia');
            $table->unsignedBigInteger('fk_img_id')->nullable();
            $table->unsignedBigInteger('fk_res_id')->nullable();
            $table->unsignedBigInteger('fk_users_id')->nullable();
            $table->unsignedBigInteger('fk_pro_id')->nullable();
            //tem problemas em estoque. comentar o relacionamenot com reservas arruma
            
            $table->foreign('fk_img_id')->references('id')->on('imagem');
            $table->foreign('fk_res_id')->references('id')->on('reservas');
            $table->foreign('fk_users_id')->references('id')->on('users');
            $table->foreign('fk_pro_id')->references('id')->on('promocoes');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoque');
    }
};
