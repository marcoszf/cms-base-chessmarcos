<?php

Route::get('/', 'MainSiteController@index');
Route::post('contact', 'MainSiteController@sendContact');

/** ------------------------------------------
 *  Admin CMS Routes
 *  ------------------------------------------
 */
Route::get('cms', 'MainCmsController@index');

# News Management
Route::post('news/upload', 'NewsController@postUpload');
Route::delete('news/{news}/exclude', 'NewsController@getDelete');
Route::get('news/showList', 'NewsController@getShow');
Route::get('news/showInsert', 'NewsController@getInsert');
Route::get('news/{user}/showEdit', 'NewsController@getEdit');
Route::post('news/insert','NewsController@postInsert');
Route::post('news/update/{news}', array('as' => 'news.update', 'uses' => 'NewsController@postEdit'));

	# Banners Management
Route::delete('banner/{banner}/exclude', 'BannerController@getDelete');
Route::get('banner/showList', 'BannerController@getShow');
Route::get('banner/showInsert', 'BannerController@getInsert');
Route::get('banner/{user}/showEdit', 'BannerController@getEdit');
Route::post('banner/insert','BannerController@postInsert');
Route::post('banner/update/{banner}', array('as' => 'banner.update', 'uses' => 'BannerController@postEdit'));

	# Contacts Management
Route::get('contact/showList', 'ContactController@getShow'); #exibe listagem dos contatos
Route::get('contact/{contact}/exclude', 'ContactController@getDelete');
Route::get('contact/showInsert', 'ContactController@getInsert');
Route::get('contact/insert', 'ContactController@postInsert');

	# User Role Management
Route::get('user/{user}/exclude', 'UserController@getDelete');
Route::post('user/update/{user}', array('as' => 'user.update', 'uses' => 'UserController@postEdit'));
Route::get('user/{user}/edit', 'UserController@getEdit');
Route::get('user/showList', 'UserController@getShow');
Route::get('user/showInsert', 'UserController@getInsert');
Route::post('user/insert','UserController@postInsert');

	# Login Management
Route::get('login', 'MainCmsController@getLogin');
Route::post('loginpost', 'MainCmsController@postLogin');
Route::get('logout', 'MainCmsController@getLogout');

//--CMS ADMIN--//