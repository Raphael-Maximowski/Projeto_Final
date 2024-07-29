<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->unsignedBigInteger('empresa_id')->nullable(); 

            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropForeign(['empresa_id']); 
            $table->dropColumn('empresa_id'); 
        });
    }
};
