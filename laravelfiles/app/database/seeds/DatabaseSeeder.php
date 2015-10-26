<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$this->call('ContactTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('BannerTableSeeder');
		$this->call('NewsTableSeeder');
		
	}

}
