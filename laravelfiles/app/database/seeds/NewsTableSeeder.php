<?php

class NewsTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('tab_news')->delete();
	    News::create(array(
			'title'     => 'Notícia teste 01',
			'text'      => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta dolores sunt, pariatur adipisci, reiciendis nihil atque odio, laboriosam deleniti..',
			'summary'   => 'Lorem ipsum dolor sit amet...',
			'date' 			=> '2014-06-21',
			'category'  => 1,
			'source'   	=> 'http://www.google.com',
			'status'	 	=> 'A'
	    ));

	    News::create(array(
			'title'     => 'Notícia teste 02',
			'text'      => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta dolores sunt, pariatur adipisci, reiciendis nihil atque odio, laboriosam deleniti..',
			'summary'   => 'Lorem ipsum dolor sit amet...',
			'date' 			=> '2014-06-21',
			'category'  => 1,
			'source'   	=> 'http://www.google.com',
			'status'	 	=> 'A'
	    ));

	    News::create(array(
			'title'     => 'Notícia teste 03',
			'text'      => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta dolores sunt, pariatur adipisci, reiciendis nihil atque odio, laboriosam deleniti..',
			'summary'   => 'Lorem ipsum dolor sit amet...',
			'date' 			=> '2014-06-21',
			'category'  => 1,
			'source'   	=> 'http://www.google.com',
			'status'	 	=> 'A'
	    ));

	    News::create(array(
			'title'     => 'Notícia teste 04',
			'text'      => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta dolores sunt, pariatur adipisci, reiciendis nihil atque odio, laboriosam deleniti..',
			'summary'   => 'Lorem ipsum dolor sit amet...',
			'date' 			=> '2014-06-21',
			'category'  => 1,
			'source'   	=> 'http://www.google.com',
			'status'	 	=> 'A'
	    ));
	}

}
