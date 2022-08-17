<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreatePackagesTranslationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */

     public function up() {

         Schema::create('packages_translations', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('package_id')->unsigned();
             $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
             $table->integer('lang_id')->unsigned();
             $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
             $table->string('name', 255);
             $table->string('slug',255);
             $table->tinyInteger('route')->unsigined()->default(0);
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
        Schema::dropIfExists('packages_translations');
    }




}