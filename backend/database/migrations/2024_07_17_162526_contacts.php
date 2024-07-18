<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('posicao');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('cpf');
            $table->date('data_de_nascimento');
            $table->string('endereco');
            $table->decimal('value');
            $table->timestamps();

            $table->foreignId('step_id')->constrained()->onDelete('cascade');

    });
    }


    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
