<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIoiaRegisterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ioia_register', function(Blueprint $table)
		{
			$table->integer('name_id')->default(0);
			$table->integer('training_id')->default(0);
			$table->string('special_diet', 30)->default('');
			$table->decimal('test_grade', 4, 1)->default(0.0);
			$table->decimal('report_grade', 4, 1)->default(0.0);
            $table->tinyInteger('report_grade')->unsigned()->default(ReportGrade::Unsatisfactory);
            $table->tinyInteger('certificate')->unsigned()->default(Certificate::Attendance);
			$table->primary(['training_id','name_id']);
			$table->unique(['name_id','training_id'], 'TRANSCRIPT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ioia_register');
	}

}
