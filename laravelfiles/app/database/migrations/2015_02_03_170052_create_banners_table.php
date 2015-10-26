<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tab_banners', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title',100);
			$table->text('text'); #texto descritivo
			$table->dateTime('show_begin'); #inicio da exibição
			$table->dateTime('show_end'); #fim da exibição
			$table->integer('category');
			$table->string('link',150); #URL para o conteúdo do banner
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
		Schema::drop('tab_banners');
	}

}
