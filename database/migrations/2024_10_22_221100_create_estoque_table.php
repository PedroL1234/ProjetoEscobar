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
            $table->id(); // ID do estoque
            $table->string('est_tamanho');
            $table->string('est_nome');
            $table->integer('est_valor');
            $table->string('est_descricao');
            $table->integer('est_quantia');
            $table->unsignedBigInteger('fk_img_id')->nullable();
            $table->unsignedBigInteger('fk_res_id')->nullable(); // Chave estrangeira para reservas
            $table->unsignedBigInteger('fk_users_id')->nullable();
            $table->unsignedBigInteger('fk_pro_id')->nullable();
            $table->timestamps();

            // Definindo as chaves estrangeiras
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
        Schema::table('estoque', function (Blueprint $table) {
            $table->dropForeign(['fk_img_id']);
            $table->dropForeign(['fk_res_id']);
            $table->dropForeign(['fk_users_id']);
            $table->dropForeign(['fk_pro_id']);
        });

        Schema::dropIfExists('estoque');
    }
};
