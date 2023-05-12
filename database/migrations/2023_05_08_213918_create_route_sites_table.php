<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_sites', function (Blueprint $table) {
            
            $table->unsignedbigInteger('route_id');
            $table->foreign('route_id')
            ->references('id')
            ->on('routes')
            ->cascade('delete');

            $table->unsignedbigInteger('site_id');
            $table->foreign('site_id')
            ->references('id')
            ->on('sites')
            ->cascade('delete');
            $table->integer('order')->nullable();
            $table->timestamps();
            $table->primary(array('route_id','site_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('route_sites');
    }
}
