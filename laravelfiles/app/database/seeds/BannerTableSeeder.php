<?php

class BannerTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('tab_banners')->delete();
	    Banner::create(array(
			'title'     => 'Banner teste 01',
			'text'      => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta dolores sunt, pariatur adipisci, reiciendis nihil atque odio, laboriosam deleniti..',
			'show_begin' => '2014-06-21',
			'show_end'   => '2015-06-21',
			'category'   => 1,
			'link'   	 => 'http://www.google.com',
			'status'	 => 'A'
	    ));

	    Banner::create(array(
			'title'     => 'Banner teste 02',
			'text'      => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta dolores sunt, pariatur adipisci, reiciendis nihil atque odio, laboriosam deleniti..',
			'show_begin' => '2000-02-25',
			'show_end'   => '2025-01-06',
			'category'   => 1,
			'link'   	 => 'http://www.gmail.com',
			'status'	 => 'A'
	    ));

	    Banner::create(array(
			'title'     => 'Banner teste 03',
			'text'      => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta dolores sunt, pariatur adipisci, reiciendis nihil atque odio, laboriosam deleniti..',
			'show_begin' => '2000-02-25',
			'show_end'   => '2025-01-06',
			'category'   => 1,
			'link'   	 => 'http://www.gmail.com',
			'status'	 => 'A'
	    ));

	    Banner::create(array(
			'title'     => 'Banner teste 04',
			'text'      => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta dolores sunt, pariatur adipisci, reiciendis nihil atque odio, laboriosam deleniti..',
			'show_begin' => '2000-02-25',
			'show_end'   => '2025-01-06',
			'category'   => 1,
			'link'   	 => 'http://www.gmail.com',
			'status'	 => 'A'
	    ));
	}

}
