<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('admin.home');
});

Route::group([
    'prefix'        => config('admin.route.prefix') . '/api',
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->resource('projects', ProjectController::class);
    $router->resource('standards', StandardController::class);
    $router->resource('automoviles', AutomovilController::class);
    $router->resource('modelos', ModeloController::class);
    $router->resource('tipos-vehiculo', TipoVehiculoController::class);
    $router->resource('tipos-combustible', TipoCombustibleController::class);
    $router->resource('bombas-abastecimiento', BombaAbastecimientoController::class);
    $router->resource('sistemas-amortiguacion', SistemaAmortiguacionController::class);
    $router->resource('estados-medicion', EstadoMedicionController::class);
    $router->resource('generadores-gasolina', GeneradorGasolinaController::class);
    $router->resource('marcas', MarcaController::class);
    $router->resource('fields', FieldController::class);
    $router->resource('formularios', FormularioController::class);
    $router->resource('vehicles', VehicleController::class)->only([
        'index', 'show'
    ]);
    $router->resource('values', ValueController::class)->only([
        'index', 'show'
    ]);
    $router->get('/push-notifications', 'PushNotificationsController@pushNotifications')->name('pushNotifications');
    $router->post('/push-notifications', 'PushNotificationsController@sendPushNotifications')->name('sendPushNotifications');
});
