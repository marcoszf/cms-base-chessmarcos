<?php

class UserTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('tb_users')->delete();
	    User::create(array(
			'name'     => 'Marcos colombelli',
			'username' => 'colombo',
			'email'    => 'marcos.colombelli@gmail.com',
			'password' => Hash::make('anything123')
	    ));
	    User::create(array(
			'name'     => 'Marcos Deritti',
			'username' => 'marco',
			'email'    => 'marco@doisms.com',
			'password' => Hash::make('marco')
	    ));
	}

}
