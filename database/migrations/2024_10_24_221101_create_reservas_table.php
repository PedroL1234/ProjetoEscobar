<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            // $table->id();
            // $table->unsignedBigInteger('fk_pro_id'); 
            $table->unsignedBigInteger('fk_cli_id');
            $table->unsignedBigInteger('fk_est_id');
            $table->timestamps();

            // $table->foreign('fk_pro_id')->references('id')->on('promocoes')->onDelete('cascade');
            $table->foreign('fk_cli_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('fk_est_id')->references('id')->on('estoque')->onDelete('cascade');
        });
    }

};
