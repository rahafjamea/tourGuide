<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            //table->unsignedbigInteger('category');
            //$table->foreign('category')
            //->references('id')
            //->on('category_sites');
            //->cascade('delete');
            //$table->string('category');
            $table->string('opening_hours');
            $table->longText('description');
            $table->boolean('is_hidden_gem');
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
        Schema::dropIfExists('sites');
    }
}
