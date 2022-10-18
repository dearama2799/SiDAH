<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\BukuTamuController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->options(
    '/{any:.*}',
    [
        'middleware' => ['cors'],
        function () {
            return response(['status' => 'success']);
        }
    ]
);
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/', function () use ($router) {

    return "hi post";
});

$router->get('/user', function () {
    $respond = [
        "status" => "succes",
        "data" => [
            "nama" => "Dea"
        ]
    ];

    return response()->json($respond);
});

// $router->post('/login', [
//     'middleware' => 'apikey',
//     'uses' => 'AuthController@login'
// ]);

// $router->post('/user', [
//     'middleware' => 'apikey',
//     'uses' => 'UserController@login'
// ]);

// $router->post('/tamu', [
//     'middleware' => 'apikey',
//     'uses' => 'TamuController@login'
// ]);

// $router->get('/tamu', [
//     'middleware' => 'apikey',
//     'uses' => 'TamuController@login'
// ]);

// $router->put('/tamu', [
//     'middleware' => 'apikey',
//     'uses' => 'TamuController@login'
// ]);

// $router->delete('/tamu', [
//     'middleware' => 'apikey',
//     'uses' => 'TamuController@login'
// ]);

// $router->post('/tujuan', [
//     'middleware' => 'apikey',
//     'uses' => 'TujuanController@login'
// ]);

// $router->post('/buku_tamu', [
//     'middleware' => 'apikey',
//     'uses' => 'BukuTamuController@login'
// ]);

$router->group(['middleware' => ['cors', 'apikey']], function () use ($router) {
    $router->post('/login', 'AuthController@login');
    
    $router->group(['middleware' => ['jwt']], function () use ($router) {
    $router->post('/user', 'UserController@add');
    $router->post('/tamu', 'TamuController@add');
    $router->get('/tamu', 'TamuController@list');
    $router->put('/tamu', 'TamuController@update');
    $router->delete('/tamu', 'TamuController@delete');
    $router->post('/tujuan', 'TujuanController@add');
    $router->post('/buku_tamu', 'BukuTamuController@add');
    $router->get('/buku_tamu', 'BukuTamuController@list');
    $router->put('/buku_tamu', 'BukuTamuController@update');
    $router->delete('/buku_tamu', 'BukuTamuController@delete');
});
$router->get('/detailtamu/{id}', 'BukuTamuController@getDetailTamu');
});
