<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderReturnStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_return_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_detailes_id')->unsigned()->nullable();
            $table->integer('returns_id')->unsigned()->nullable();
            $table->integer('status_id')->unsigned();
            $table->string('package_number');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_return_statuses');
    }
}
