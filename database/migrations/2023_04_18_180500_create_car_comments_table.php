<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('car_comments', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('email');
            $table->text('comment');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('car_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('car_id')->on('cars')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('car_comments');
    }
}
