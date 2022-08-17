<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('lang_id')->unsigned();
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
            $table->integer('group_id')->unsigned();
            $table->index('group_id');
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->string('photo','255')->nullable();
            $table->text('entry')->nullable();
            $table->text('body')->nullable();
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->string('title')->nullable();
            $table->tinyInteger('active')->unsigned()->default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Products');
    }
}
