<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('funnel_collection', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funnel_id');
            $table->unsignedBigInteger('collection_id');
            $table->timestamps();

            $table->foreign('funnel_id')->references('id')->on('funnels')->onDelete('cascade');
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('cascade');

            
            $table->unique(['funnel_id', 'collection_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('funnel_collection');
    }

};