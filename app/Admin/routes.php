<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('order', 'OrderController');
    $router->resource('transition', 'TransitionController');
    $router->resource('member', 'MemberController');
    $router->resource('activity', 'ActivityController');
    $router->resource('synthetic', 'SyntheticController');
    $router->resource('withdrawal', 'WithdrawalController');
    $router->get('/report/summary', 'ReportController@index');
    $router->get('/report/daily', 'ReportController@daily');

//    $router->get('activity/{id}/edit', 'ActivityController@edit');
//    $router->put('activity/{id}', 'ActivityController@update');
});
