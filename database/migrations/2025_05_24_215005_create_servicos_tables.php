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
        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->enum('status', ['Aberta', 'Em Atendimento', 'Concluida'])->default('Aberta');
            $table->string('titulo');
            $table->text('descricao');
            $table->timestamps();
            $table->foreign('cliente_id')->references('id')->on('users');
        });
          Schema::create('andamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tecnico_id');
            $table->unsignedBigInteger('sevico_id');
            $table->text('descricao');
            $table->timestamps();
            $table->foreign('tecnico_id')->references('id')->on('users');
            $table->foreign('sevico_id')->references('id')->on('servicos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('andamentos');
        Schema::dropIfExists('servicos');
    }
};
