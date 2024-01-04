<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_country', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city', 25);
            $table->string('municipality', 25);
            $table->string('county', 25);
            $table->integer('post_code');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_country');
    }
}
