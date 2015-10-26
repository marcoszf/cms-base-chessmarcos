<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tab_images', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('module_id');
			$table->string('module_title', 80);
			$table->string('title', 250);
			$table->text('description');
			$table->smallInteger('cape');
			$table->smallInteger('order');
			$table->enum('status', array('A', 'I'));
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tab_images');
	}

}
