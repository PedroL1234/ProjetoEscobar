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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id(); // ID da reserva
            $table->unsignedBigInteger('fk_pro_id'); // Chave estrangeira para promocoes
            $table->unsignedBigInteger('fk_cli_id'); // Chave estrangeira para clientes
            $table->unsignedBigInteger('fk_est_id'); // Chave estrangeira para estoque
            $table->timestamps();

            $table->foreign('fk_pro_id')->references('id')->on('promocoes')->onDelete('cascade');
            $table->foreign('fk_cli_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('fk_est_id')->references('id')->on('estoque')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
