<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePMAPdfPagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PMA_pdf_pages', function(Blueprint $table)
		{
			$table->string('db_name')->default('')->index('db_name');
			$table->increments('page_nr');
			$table->string('page_descr')->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('PMA_pdf_pages');
	}

}
