<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->id(); 
            $table->text('text'); 
            $table->string('room'); 
            $table->string('username');  
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message');
    }
};
