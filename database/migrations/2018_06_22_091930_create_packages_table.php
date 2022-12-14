<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('provider', 255);
            $table->string('author', 255);
            $table->string('url', 255);
            $table->string('version', 30);
            $table->string('description', 255)->nullable();
            $table->string('icon', 30);
            $table->tinyInteger('status')->unsigined()->default(0);
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
        Schema::dropIfExists('packages');
    }
}
