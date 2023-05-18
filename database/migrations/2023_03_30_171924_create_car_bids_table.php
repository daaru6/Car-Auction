<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarBidsTable extends Migration
{
    public function up()
    {
        Schema::create('car_bids', function (Blueprint $table) {

            $table->id('bid_id');
            $table->unsignedBigInteger('bid_amount');
            $table->boolean('is_winner')->default(0);
            $table->boolean('is_rejected')->default(0);
            $table->boolean('is_paid')->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('car_bids');
    }
}
