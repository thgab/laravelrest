<?php
use Illuminate\Http\Response as IlluminateResponse;
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
Route::get('/', function()
{
  return View::make('webapp');
});

Route::group(array('prefix' => 'api'), function()
{
	// URL parameter binding
	Route::bind('name', array('RobotController','robotName'));
	Route::bind('type', array('RobotController','robotType'));
	
	// RobotController routing
	Route::get('robots/filter', 'RobotController@typeList');
	Route::get('robots/search/{name}','RobotController@search');
	Route::get('robots/filter/{type}', 'RobotController@search');
	
	// RobotController RESTFUL resource
	Route::resource('robots', 'RobotController');
});

// ===============================================
// 404 ===========================================
// ===============================================

App::missing(function($exception)
{
	return Response::json(array(), IlluminateResponse::HTTP_NOT_FOUND);
});