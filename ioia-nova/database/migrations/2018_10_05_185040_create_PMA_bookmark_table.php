<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePMABookmarkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PMA_bookmark', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('dbase')->default('');
			$table->string('user')->default('');
			$table->string('label')->default('');
			$table->text('query', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('PMA_bookmark');
	}

}
