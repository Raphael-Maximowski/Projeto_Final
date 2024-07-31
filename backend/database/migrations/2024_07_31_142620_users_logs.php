<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('users_logs', function (Blueprint $table){
            $table->id();
            $table->string('actions');
            $table->string('details');
            $table->timestamp('created_at')->useCurrent();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_logs');
    }
};
