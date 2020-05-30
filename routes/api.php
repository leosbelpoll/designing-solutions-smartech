<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Auth routes
Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login')->name('auth.login');
    Route::post('logout', 'AuthController@logout')->name('auth.logout');
    Route::post('refresh', 'AuthController@refresh')->name('auth.refresh');
    Route::post('me', 'AuthController@me')->name('auth.me');
});

Route::middleware('auth:api')->group(function ($router) {
    Route::get('/version', 'Controller@getVersion')->name('getVersion');

    // Projects routes
    Route::get('/projects', 'ProjectController@getAll')->name('getAllProjects');
    Route::get('/projects/{id}', 'ProjectController@get')->name('getProject');

    // Standards routes
    Route::get('/standards', 'StandardController@getAll')->name('getAllStandards');
    Route::get('/standards/{id}', 'StandardController@get')->name('getStandard');

    // Formularios routes
    Route::get('/formularios', 'FormularioController@getAll')->name('getAllFormularios');
    Route::get('/formularios/{id}', 'FormularioController@get')->name('getFormulario');

    // Vehicles routes
    Route::post('/vehicles', 'VehicleController@store')->name('createVehicle');


    // Nomencladores

    Route::get('/automoviles', 'AutomovilController@getAll')->name('getAllAutomoviles');
    Route::get('/automoviles/{id}', 'AutomovilController@getAll')->name('getAutomoviles');

    Route::get('/bombas-abastecimiento', 'BombaAbastecimientoController@getAll')->name('getAllBombasAbastecimiento');
    Route::get('/bombas-abastecimiento/{id}', 'BombaAbastecimientoController@getAll')->name('getBombasAbastecimiento');

    Route::get('/sistemas-amortiguacion', 'SistemaAmortiguacionController@getAll')->name('getAllSistemasAmortiguacion');
    Route::get('/sistemas-amortiguacion/{id}', 'SistemaAmortiguacionController@getAll')->name('getSistemasAmortiguacion');

    Route::get('/estados-medicion', 'EstadoMedicionController@getAll')->name('getAllEstadosMedicion');
    Route::get('/estados-medicion/{id}', 'EstadoMedicionController@getAll')->name('getEstadosMedicion');

    Route::get('/generadores-gasolina', 'GeneradorGasolinaController@getAll')->name('getAllGeneradoresGasolina');
    Route::get('/generadores-gasolina/{id}', 'GeneradorGasolinaController@getAll')->name('getGeneradoresGasolina');

    Route::get('/marcas', 'MarcaController@getAll')->name('getAllMarcas');
    Route::get('/marcas/{id}', 'MarcaController@getAll')->name('getMarcas');

    Route::get('/modelos', 'ModeloController@getAll')->name('getAllModelos');
    Route::get('/modelos/{id}', 'ModeloController@getAll')->name('getModelos');

    Route::get('/tipos-vehiculos', 'TipoVehiculoController@getAll')->name('getAllTiposVehiculo');
    Route::get('/tipos-vehiculos/{id}', 'TipoVehiculoController@getAll')->name('getTiposVehiculo');

    Route::get('/tipos-combustible', 'TipoCombustibleaController@getAll')->name('getAllTiposCombustible');
    Route::get('/tipos-combustible/{id}', 'TipoCombustibleaController@getAll')->name('getTiposCombustible');

    // Form Data

    Route::post('/save-values', 'ValueController@saveValues')->name('saveValues');

    Route::post('/set-push-notification-token', 'UserController@setPushNotificationToken')->name('setPushNotificationToken');
});
