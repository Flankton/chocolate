<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCocoaLoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cocoa_lote', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable;
            $table->unsignedBigInteger('provider_id');
            $table->boolean('organic');
            $table->boolean('deleted')->default(false);
            $table->timestamps();
            $table->foreign('provider_id')->references('id')->on('provider');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cocoa_lote');
    }
}
