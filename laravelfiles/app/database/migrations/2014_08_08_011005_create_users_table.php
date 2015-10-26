<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_users', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name', 32);
			$table->string('lastname', 50);
			$table->string('address', 50);
			$table->string('neighborhood', 50);
			$table->string('city', 50);
			$table->string('state', 50);
			$table->string('cep', 50);
			$table->char('sex', 1);
			$table->string('telephone', 40);
			$table->string('imgcustom', 100);
			$table->string('username', 32);
			$table->string('email', 320);
			$table->string('password', 64);

			// required for Laravel 4.1.26
            $table->string('remember_token', 100)->nullable();
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
		Schema::drop('tb_users');
	}

}
