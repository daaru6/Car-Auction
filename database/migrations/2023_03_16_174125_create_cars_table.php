<?php

use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {

            $table->id('car_id');
            $table->string('car_name', 500);
            $table->text('slug');
            $table->text('description')->nullable();
            $table->text('image');
            $table->tinyInteger('car_type')->unsigned();
            $table->integer('price');
            $table->date('expiry_date');
            $table->boolean('is_sold')->default(0);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
