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
            $table->unsignedBigInteger('fk_res_id')->nullable()->change(); // Permite nulos
        });
    }
    
    public function down()
    {
        Schema::table('estoque', function (Blueprint $table) {
            $table->unsignedBigInteger('fk_res_id')->nullable(false)->change(); // Reverte a mudança
        });
    }
    
};
