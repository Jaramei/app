<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('lang_id')->unsigned();
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->integer('group_id')->unsigned();
            $table->index('group_id');
            $table->string('number', 150);
            $table->string('name', 150);
            $table->string('slug', 255);
            $table->string('photo','255');
            $table->text('entry')->nullable();
            $table->text('body');
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
