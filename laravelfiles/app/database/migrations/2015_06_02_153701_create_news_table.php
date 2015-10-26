<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tab_news', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title',100);
			$table->text('text'); #texto descritivo
			$table->string('summary', 250); #resumo
			$table->dateTime('date'); #data da notícia
			$table->integer('category');
			$table->string('source',150); #URL fonte
			$table->char('status',1);
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
		Schema::drop('tab_news');
	}

}
