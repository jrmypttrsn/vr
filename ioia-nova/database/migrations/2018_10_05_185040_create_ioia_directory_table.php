<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIoiaDirectoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ioia_directory', function(Blueprint $table)
		{
			$table->integer('name_id')->default(0)->primary();
			$table->text('other_training', 65535)->nullable();
			$table->text('farm_experience', 65535)->nullable();
			$table->string('other_farm_experience')->default('');
			$table->text('livestock_experience', 65535)->nullable();
			$table->string('other_livestock_experience')->default('');
			$table->text('process_experience', 65535)->nullable();
			$table->string('other_process_experience')->default('');
			$table->text('academic', 65535)->nullable();
			$table->text('personal', 65535)->nullable();
			$table->text('inspect_org', 65535)->nullable();
			$table->boolean('mentor')->default('');
			$table->boolean('consult')->default('');
			$table->boolean('review')->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ioia_directory');
	}

}
