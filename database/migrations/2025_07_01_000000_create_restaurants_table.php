<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('restaurant_type');
            $table->string('restaurant_name');
            $table->string('restaurant_slug')->unique();
            $table->string('restaurant_address');
            $table->longText('restaurant_description')->nullable();
            $table->string('restaurant_logo')->nullable();
            $table->decimal('delivery_charge', 8, 2)->default(0);
            $table->float('review_avg', 3, 2)->default(0);
            $table->tinyInteger('open_monday')->nullable()->default(0);
            $table->tinyInteger('open_tuesday')->nullable()->default(0);
            $table->tinyInteger('open_wednesday')->nullable()->default(0);
            $table->tinyInteger('open_thursday')->nullable()->default(0);
            $table->tinyInteger('open_friday')->nullable()->default(0);
            $table->tinyInteger('open_saturday')->nullable()->default(0);
            $table->tinyInteger('open_sunday')->nullable()->default(0);
            // No timestamps as per model
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurants');
    }
} 