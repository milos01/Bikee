<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses'=>'HomeController@showWelcome', 'as'=>'home'))->before('guest');

Route::group(array('prefix'=>'/user','before'=>'auth'),function(){
	Route::get('/', array('uses'=>'UserController@userHome', 'as'=>'userHome'));
	Route::post('/', array('uses'=>'UserController@userHome', 'as'=>'userHomeTwo'));
	Route::get('/profile/{username}', array('uses'=>'UserController@userHomeMain', 'as'=>'userHomeMain'));
	Route::get('/search/{tip}/{cont}',array('uses'=>'UserController@searchBike','as'=>'searchBike'));
 	Route::post('/add',array('uses'=>'BikeController@addBike','as'=>'addBike'));
 	Route::get('/bike/{id}',array('uses'=>'BikeController@showBike','as'=>'showBike'));
 	Route::get('/rentedb',array('uses'=>'RentController@viewRented','as'=>'viewRented'));
 	Route::get('/bike/rate/{id}/{mark}',array('uses'=>'BikeController@rateBike','as'=>'rateBike'));
 	Route::post('/bike/comment/{id}/{idb}',array('uses'=>'CommentController@postComment','as'=>'postComment'));
 	Route::get('/bike/edit/{id}',array('uses'=>'BikeController@editBike','as'=>'editBike'));
 	Route::get('/bike/sort/{id}',array('uses'=>'UserController@sortBikes','as'=>'sortBikes'));
 	Route::post('/view',array('uses'=>'UserController@viewBikes','as'=>'viewBikes'));
 	Route::post('/bike/editb/{id}',array('uses'=>'BikeController@editBikeAll','as'=>'editBikeAll'));
 	Route::post('/bike/rent/{id}/{nadlezni}',array('uses'=>'RentController@rentBike','as'=>'rentBike'));

});
Route::group(array('before' => 'guest'),function(){
	Route::group(array('before' => 'csrf'),function(){
		Route::post('/user/create', array('uses'=>'UserController@postCreate','as'=>'postCreate'));
		Route::post('/user/login', array('uses'=>'UserController@postLogin','as'=>'postLogin'));
	});
});

Route::group(array('before'=>'auth'), function(){
	Route::get('user/logout',array('uses'=>'UserController@getLogout','as'=>'getLogout'));

});