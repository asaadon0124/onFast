<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderDetailesTable extends Migration {

	public function up()
	{
		Schema::create('order_detailes', function(Blueprint $table) {
			$table->increments('id');
            $table->date('created_at');
			$table->date('updated_at');
            $table->integer('product_id')->unsigned();
			$table->integer('shipping_price')->unsigned()->default(0);
			$table->integer('total_price')->unsigned()->default(0);
			$table->integer('order_id')->unsigned()->nullable();
			$table->integer('admin_id')->unsigned()->nullable();
			$table->string('product_status', 255);
			$table->text('notes')->nullable();
						$table->integer('type')->default(0);

			$table->softDeletes();


		});
	}

	public function down()
	{
		Schema::drop('order_detailes');
	}
}
