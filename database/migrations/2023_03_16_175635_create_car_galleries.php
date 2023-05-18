<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarGalleries extends Migration
{
    public function up()
    {
        Schema::create('car_galleries', function (Blueprint $table) {

            $table->id('car_gallery_id');
            $table->text('image');
            $table->unsignedBigInteger('car_id');
            $table->timestamps();
            $table->foreign('car_id')->references('car_id')->on('cars')->onDelete('cascade');
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('car_galleries');
    }
}
