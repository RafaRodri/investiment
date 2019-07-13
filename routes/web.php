<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Direcionar processamento para o controller (formato controller@metodo)
//Route::get('/', ['uses' => 'Controller@homepage']);
Route::get('/', ['uses' => 'Controller@logar']);
Route::get('/cadastro', ['uses' => 'Controller@cadastrar']);


/**
 * Routes to user auth
 * ======================================================================
 */
Route::get('/login', ['uses' => 'Controller@logar']);
Route::post('/login', ['as' => 'user.login', 'uses' => 'DashboardController@auth']);
Route::get('/logout', ['as' => 'user.logout', 'uses' => 'DashboardController@logout']);

Route::get('/dashboard', ['as' => 'user.dashboard', 'uses' => 'DashboardController@index']);


/* ======================================= moviment ======================================= */
Route::get('user/moviment', ['as' => 'moviment.index', 'uses' => 'MovimentsController@index']);

Route::get('moviment/all', ['as' => 'moviment.all', 'uses' => 'MovimentsController@all']);


/* ====================================== application ===================================== */
Route::get('moviment', ['as' => 'moviment.application', 'uses' => 'MovimentsController@application']);
Route::post('moviment', ['as' => 'moviment.application.store', 'uses' => 'MovimentsController@storeApplication']);
/* ======================================= withdraw ======================================= */
Route::get('withdraw', ['as' => 'moviment.withdraw', 'uses' => 'MovimentsController@withdraw']);
Route::post('withdraw', ['as' => 'moviment.withdraw.store', 'uses' => 'MovimentsController@storeWithdraw']);


/* ======================================================================================== */
/**
 * Rota implicita
 *
 * Params:
 * nome da rota,
 * nome do controller,
 * array de dados com nome das rotas por grupo
 */
Route::resource('user', 'UsersController');
Route::resource('institution', 'InstitutionsController');
Route::resource('group', 'GroupsController');

/** como produto pertence a Instituição, podemos colocar o escopo de produto dentro do de instituição */
Route::resource('institution.product', 'ProductsController');


/* ========================================  group ======================================== */
Route::post('group/{group_id}/user', ['as' => 'group.user.store', 'uses' => 'GroupsController@userStore']);
