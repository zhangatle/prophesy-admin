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
    $router->get('/report/summary', 'ReportController@index');
    $router->get('/report/daily', 'ReportController@daily');
    $router->resource('promo', 'PromoController');
    $router->resource('result', 'ResultController');

    $router->post("activity/save", 'ActivityController@doCreate');
    $router->put("activity/save/{id}", 'ActivityController@doUpdate');

    $router->any('/image/upload', 'ActivityController@uploadImg');

    $router->post("result/save", 'ResultController@doCreate');
    $router->put("result/save/{id}", 'ResultController@doUpdate');
});
