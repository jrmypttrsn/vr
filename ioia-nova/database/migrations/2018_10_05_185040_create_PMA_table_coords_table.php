<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePMATableCoordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PMA_table_coords', function(Blueprint $table)
		{
			$table->string('db_name', 64)->default('');
			$table->string('table_name', 64)->default('');
			$table->integer('pdf_page_number')->default(0);
			$table->float('x', 10, 0)->unsigned()->default(0);
			$table->float('y', 10, 0)->unsigned()->default(0);
			$table->primary(['db_name','table_name','pdf_page_number']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('PMA_table_coords');
	}

}
