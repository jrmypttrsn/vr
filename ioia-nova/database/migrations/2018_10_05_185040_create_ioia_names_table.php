<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIoiaNamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ioia_names', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('userid')->default('');
			$table->string('password')->default('');
			$table->string('bus_name')->default('');
			$table->string('firstname')->default('');
			$table->string('middle')->default('');
			$table->string('lname')->default('');
			$table->string('address1')->default('');
			$table->string('address2')->default('');
			$table->string('city')->default('');
			$table->string('state_code')->default('');
			$table->string('zip')->default('');
			$table->string('country_code')->default('');
			$table->string('hphone')->default('');
			$table->string('cphone')->default('');
			$table->string('wphone')->default('');
			$table->string('fax')->default('');
			$table->string('email')->default('');
			$table->smallInteger('num_news')->unsigned()->default(0);
			$table->string('subscription')->default('');
			$table->string('status')->default('')->index('STATUS');
			$table->string('training')->default('');
			$table->char('active')->default('');
			$table->text('comment', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ioia_names');
	}

}
