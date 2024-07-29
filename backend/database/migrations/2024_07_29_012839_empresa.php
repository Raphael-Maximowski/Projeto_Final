<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id(); 
            $table->string('nome'); 
            $table->string('razao'); 
            $table->string('cnpj'); 
            $table->string('inscri_estadual')->nullable(); 
            $table->string('fundacao'); 
            $table->timestamps(); 

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
