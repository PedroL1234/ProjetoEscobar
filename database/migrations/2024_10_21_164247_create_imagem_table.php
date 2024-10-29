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
    Schema::create('imagem', function (Blueprint $table) {
        $table->id();
        $table->string('caminho'); // Certifique-se de que esta linha está presente
        $table->timestamps();
    });
} 

    
    public function down(): void
    {
        Schema::dropIfExists('imagem');
    }
};
