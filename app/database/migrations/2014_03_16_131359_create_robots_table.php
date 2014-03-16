<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRobotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('robots', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->enum('type', array('Android', 'Cyborg', 'Mecha'));
			$table->smallInteger('year');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('robots');
	}

}