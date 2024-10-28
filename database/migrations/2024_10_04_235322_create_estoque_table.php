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
            
            $table->foreign('fk_img_id')->references('id')->on('imagem')->onDelete('cascade');
            $table->foreign('fk_res_id')->references('id')->on('reservas')->onDelete('cascade');
            $table->foreign('fk_users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('fk_pro_id')->references('id')->on('promocoes')->onDelete('cascade');
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
