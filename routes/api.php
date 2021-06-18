<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Dusterio\LumenPassport\LumenPassport;
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

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->post('/login', 'AuthController@login');
$router->post('/register', 'RegisterController@store');
$router->get('/confirm-account/{token}', 'RegisterController@confirmAccount');

$router->post('/password-recovery', 'PasswordRecoveryController@sendPasswordRecovery');
$router->post('/password-change', 'PasswordRecoveryController@changePassword');


$router->get('/cards', 'CardController@index'); // lista todas as cartas/items
$router->get('/cards/{id}', 'CardController@show'); // listar somente um card com o id enviado

$router->group(['middleware' => 'auth:api'], function ($router) {
    $router->get('/me', function (Request $request) {
        return [
            'user' => $request->user()
        ];
    });
    $router->post('/logout', 'AuthController@logout');

    $router->group(['prefix' => 'cards'], function ($router) {
        $router->post('/', 'CardController@store'); // criar um card
        $router->put('/{id}', 'CardController@update'); // atualizar um card

        $router->delete('/{id}', 'CardController@delete');
    });
});
