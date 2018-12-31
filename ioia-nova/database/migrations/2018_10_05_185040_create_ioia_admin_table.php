, 42%<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIoiaAdminTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ioia_admin', function(Blueprint $table)
		{
			$table->boolean('admin_id')->primary();
			$table->integer('name_id')->unsigned()->default(0)->unique('name_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ioia_admin');
	}

}
