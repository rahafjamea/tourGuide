<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {

            $table->id();
            $table->string('image');
            $table->unsignedbigInteger('site_id')->nullable();
            $table->foreign('site_id')
            ->references('id')
            ->on('sites')
            ->cascade('delete');
            //$table->string('alt')->nullable();

            //$table->string('mime_type')->nullable();
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
        Schema::dropIfExists('images');
    }
}
