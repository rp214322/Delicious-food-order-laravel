<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_review', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('restaurant_id');
            $table->unsignedInteger('user_id');
            $table->text('review_text')->nullable();
            $table->tinyInteger('food_quality');
            $table->tinyInteger('price');
            $table->tinyInteger('punctuality');
            $table->tinyInteger('courtesy');
            $table->integer('date'); // Unix timestamp

            // Indexes and foreign keys (optional, but recommended)
            $table->index('restaurant_id');
            $table->index('user_id');
            // Uncomment if you want to enforce foreign key constraints:
            // $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_review');
    }
} 