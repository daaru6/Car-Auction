<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarCategories extends Migration
{
    public function up()
    {
        Schema::create('car_categories', function (Blueprint $table) {

            $table->id('category_id');
            $table->string('category_name', 500);
            $table->text('slug');
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('car_categories');
    }
}
