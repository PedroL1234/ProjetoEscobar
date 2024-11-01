<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estoque', function (Blueprint $table) {
            $table->id();  // Certifique-se de que esta coluna é um unsignedBigInteger
            $table->string('est_tamanho');
            $table->string('est_nome');
            $table->string('est_valor');
            $table->string('est_descricao');
            $table->integer('est_quantia');
            $table->unsignedBigInteger('fk_img_id')->nullable();
            // $table->unsignedBigInteger('fk_res_id')->nullable();
            $table->unsignedBigInteger('fk_users_id')->nullable();
            // $table->unsignedBigInteger('fk_pro_id')->nullable();

            // Defina as chaves estrangeiras
            $table->foreign('fk_img_id')->references('id')->on('imagem')->onDelete('cascade');
            // Remova ou comente a linha abaixo se você não precisa dela
            // $table->foreign('fk_res_id')->references('id')->on('reservas')->onDelete('cascade');
            $table->foreign('fk_users_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('fk_pro_id')->references('id')->on('promocoes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estoque');
    }
};

