<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			// $table->timestamps();
			$table->date('created_at');
			$table->date('updated_at');
			$table->date('rescive_date');
			$table->string('resever_name', 100);
			$table->string('resver_phone', 100)->unique();
			$table->integer('supplier_id')->unsigned();
			$table->integer('city_id')->unsigned();
			$table->integer('admin_id')->unsigned()->nullable();
			$table->string('adress', 255);
			$table->integer('product_price')->unsigned();
			$table->integer('shipping_price')->unsigned();
			$table->integer('total_price')->unsigned();
			$table->integer('status_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('package_number');
			$table->text('notes')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
