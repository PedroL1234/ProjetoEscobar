<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('estoque', function (Blueprint $table) {
        $table->unsignedBigInteger('fk_res_id'); // Campo para chave estrangeira
        $table->foreign('fk_res_id')->references('id')->on('reservas');
    });
}

public function down()
{
    Schema::table('estoque', function (Blueprint $table) {
        $table->dropForeign(['fk_res_id']); // Remove a chave estrangeira
        $table->dropColumn('fk_res_id');    // Remove o campo
    });
}

    
};
