<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers',function(Blueprint $table){

            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('lang_id')->unsigned()->index();
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
            $table->string('name',255);
            $table->string('slug')->unigue();
            $table->string('entry',255);
            $table->longText('body');
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->string('title')->nullable();
            $table->string('photo',255)->nullable();
            $table->integer('active');
            $table->integer('sort');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Offers');
    }
}
