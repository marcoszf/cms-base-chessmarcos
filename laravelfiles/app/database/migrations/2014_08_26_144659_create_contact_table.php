<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tab_contact', function($table)
		{
		    $table->increments('id');
		    $table->string('name', 100);
		    $table->string('email', 50);
		    $table->string('subject', 150);
		    $table->text('description');
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
		Schema::drop('tab_contact');
	}
}
