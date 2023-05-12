<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorySitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_sites', function (Blueprint $table) {
            $table->unsignedbigInteger('category_id');
            $table->foreign('category_id')
            ->references('id')
            ->on('sites')
            ->cascade('delete');

            $table->unsignedbigInteger('site_id');
            $table->foreign('site_id')
            ->references('id')
            ->on('sites')
            ->cascade('delete');
            $table->timestamps();
            $table->primary(array('category_id','site_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_sites');
    }
}
