<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
    public function up2(): void
    {
        Schema::table('estoque', function (Blueprint $table) {
            // Verifique se a coluna não existe antes de adicioná-la
            if (!Schema::hasColumn('estoque', 'fk_res_id')) {
                $table->unsignedBigInteger('fk_res_id')->default(0)->change();
                $table->foreign('fk_res_id')->references('id')->on('reservas')->onDelete('cascade'); // Adicionar chave estrangeira
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down2(): void
    {
        Schema::table('estoque', function (Blueprint $table) {
            $table->dropForeign(['fk_res_id']); // Remove a chave estrangeira
            $table->dropColumn('fk_res_id');    // Remove o campo
        });
    }
    public function up(): void
    {
        Schema::create('estoque', function (Blueprint $table) {
            $table->timestamps();
            $table->id();
            $table->string('est_tamanho');
            $table->string('est_nome');
            $table->integer('est_valor');
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
