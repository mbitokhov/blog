<?php

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

$controllers = [
    'BlogPostController' => '/blog_posts',
];

if(env('APP_ENV') !== 'production')
{
    $controllers['SandboxController'] = '/sandbox';
}

foreach($controllers as $controller => $route)
{
    $router->get   ($route          , $controller . '@index');
    $router->get   ($route . '/{id}', $controller . '@getModel');
    $router->post  ($route          , $controller . '@createModel');
    $router->put   ($route . '/{id}', $controller . '@updateModel');
    $router->delete($route . '/{id}', $controller . '@deleteModel');
}
