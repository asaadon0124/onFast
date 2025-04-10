<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnsDetailesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returns_detailes', function (Blueprint $table) {
            $table->increments('id');
			$table->date('created_at');
			$table->date('updated_at');
			$table->integer('returns_id')->unsigned();
			$table->integer('shipping_price')->unsigned()->default(0);
			$table->integer('total_price')->unsigned()->default(0);
			$table->integer('order_id')->unsigned()->nullable();
			$table->string('product_status', 255);
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
        Schema::dropIfExists('returns_detailes');
    }
}
