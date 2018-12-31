<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIoiaTrainingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ioia_training', function(Blueprint $table)
		{
			$table->increments('training_id');
			$table->string('city')->default('');
			$table->string('state')->default('');
			$table->string('country')->default('');
			$table->date('date_beg')->default('0000-00-00');
			$table->date('date_end')->default('0000-00-00');
			$table->string('training_type')->default('');
			$table->string('sponsor')->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ioia_training');
	}

}
