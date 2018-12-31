<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePMARelationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('PMA_relation', function(Blueprint $table)
		{
			$table->string('master_db')->default('');
			$table->string('master_table')->default('');
			$table->string('master_field')->default('');
			$table->string('foreign_db')->default('');
			$table->string('foreign_table')->default('');
			$table->string('foreign_field')->default('');
			$table->primary(['master_db','master_table','master_field']);
			$table->index(['foreign_db','foreign_table'], 'foreign_field');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('PMA_relation');
	}

}
