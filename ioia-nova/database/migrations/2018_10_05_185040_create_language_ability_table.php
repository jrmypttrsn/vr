zz<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLanguageAbilityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('language_ability', function(Blueprint $table)
		{
			$table->increments('lang_abil_id');
			$table->integer('name_id')->default(0);
			$table->boolean('lang_id')->default(0);
			$table->char('lang_ability', 1)->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('language_ability');
	}

}
