<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePMATableInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PMA_table_info', function(Blueprint $table)
		{
			$table->string('db_name')->default('');
			$table->string('table_name')->default('');
			$table->string('display_field')->default('');
			$table->primary(['db_name','table_name']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('PMA_table_info');
	}

}
