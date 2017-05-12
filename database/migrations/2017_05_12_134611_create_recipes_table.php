<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('recipe_id');
            $table->string('publisher');
            $table->string('f2f_url', 512);
            $table->string('title');
            $table->string('source_url', 512);
            $table->string('image_url', 512);
            $table->double('social_rank');
            $table->string('publisher_url', 512);
            $table->text('ingredients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
