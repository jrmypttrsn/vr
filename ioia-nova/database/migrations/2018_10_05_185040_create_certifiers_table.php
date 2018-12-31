<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCertifiersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('certifiers', function(Blueprint $table)
		{
			$table->increments('certifier_id');
			$table->string('abbreviated_name')->default('')->unique('abbreviated_name');
			$table->string('full_name')->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('certifiers');
	}

}
