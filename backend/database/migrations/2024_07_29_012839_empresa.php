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

            $table->foreignId('admin_id')->constrained('admin_users')->onDelete('cascade');
        });
    }

   
    public function down(): void
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
        });
        Schema::dropIfExists('empresas');
    }
};
