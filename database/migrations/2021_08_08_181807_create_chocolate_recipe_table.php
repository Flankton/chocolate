<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChocolateRecipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chocolate_recipe', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cocoa_lote_id');
            $table->unsignedBigInteger('chocolate_bar_id');
            $table->string('weight');
            $table->boolean('deleted')->default(false);
            $table->timestamps();
            $table->foreign('cocoa_lote_id')->references('id')->on('cocoa_lote');
            $table->foreign('chocolate_bar_id')->references('id')->on('chocolate_bar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chocolate_recipe');
    }
}
