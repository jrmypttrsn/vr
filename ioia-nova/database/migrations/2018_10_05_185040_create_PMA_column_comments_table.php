<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePMAColumnCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PMA_column_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('db_name')->default('');
			$table->string('table_name')->default('');
			$table->string('column_name')->default('');
			$table->string('comment')->default('');
			$table->unique(['db_name','table_name','column_name'], 'db_name');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('PMA_column_comments');
	}

}
