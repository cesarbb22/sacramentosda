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

Route::get('/', 'Auth\LoginController@login');

Route::get('/login', 'Auth\LoginController@login');

Route::get('/contacto', function () {
    return view('UserViews.Contacto');
});

Route::get('/emailRecuperacion', function () {
    return view('auth.passwords.email');
});

Route::get('/registro', [
    'as' => 'registro',
    'uses' => 'Auth\RegisterController@index'
]);


Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function() {

    Route::get('/contact', function () {
        return view('AdminViews.ContactoAdmin');
    });

    Route::get('/consultaAdmin', 'consultaAdmin@home')->middleware('auth');

    Route::get('/solicitudRechazadaAdmin/{id}', 'CentroNotificaciones@rechazarSolicitud')->middleware('auth');

    Route::get('/centroNotificacionAdmin', 'CentroNotificaciones@notificacion')->middleware('auth');

    Route::get('/solicitudAceptadaAdmin/{id}', 'CentroNotificaciones@aceptarSolicitud')->middleware('auth');

    Route::post('/crearActa', 'ActaAdminController@crearActa');

    Route::post('/actualizarUsuario', 'UserController@editarUsuarioAdmin');

    Route::get('/Eliminar{id}',['as' => '/Eliminar', 'uses' => 'ActaAdminController@EliminarActa'])->middleware('auth');

    Route::get('/ActasAdmin', 'ActaAdminController@home')->middleware('auth');

    Route::post('/obtenerSolicitudes', 'CentroNotificaciones@obtenerSolicitudesAdmin')->middleware('auth');

    Route::get('/Editar/{id}', 'ActaAdminController@EditarActa')->middleware('auth');

    Route::get('/mantenimientoUsuarios', 'UserController@home')->middleware('auth');

    Route::get('/agregarUsuario', 'UserController@index2')->middleware('auth');

    Route::post('/crearUsuario', 'UserController@agregarUsuario');

    Route::get('/Editar/Usuario/{id}',['as' => '/Editar/Usuario/{id}', 'uses' => 'UserController@mostrarUsuario'])->middleware('auth');

    Route::get('/EliminarUsuario{id}',['as' => '/EliminarUsuario', 'uses' => 'UserController@EliminarUsuario'])->middleware('auth');

    Route::post('/actualizarActa', 'ActaAdminController@actualizarActa');

    Route::post('/actualizarActaNotificaciones', 'ActaAdminController@actualizarActaNotificaciones');

    Route::get('/Detalle/{id}',['as' => '/Detalle', 'uses' => 'ActaAdminController@DetalleActa'])->middleware('auth');

    Route::post('/queryPersonas', 'consultaAdmin@query');

    Route::get('/notificacionesAdmin', function () {
        return view('AdminViews.notificacionesAdmin');
    })->middleware('auth');

    Route::get('/cambiarContrasena', function () {
        return view('auth.passwords.change');
    })->middleware('auth');

});


Route::group(['middleware' => 'App\Http\Middleware\UserMiddleware'], function() {

    Route::get('/consulta', 'consultaUsuario@home')->middleware('auth');

    Route::get('/EditarUsuario/{id}',['as' => '/Editar', 'uses' => 'ActaUsuarioController@EditarActa'])->middleware('auth');

    Route::post('/EliminarUsuario',['as' => '/Eliminar', 'uses' => 'ActaUsuarioController@EliminarActa'])->middleware('auth');

    Route::post('/actualizarActaSol', 'ActaUsuarioController@actualizarActa');

    Route::get('/SolicitudEliminar{id}',['as' => '/SolicitudEliminar', 'uses' =>'SolicitudEliminarController@solicitudEliminar'])->middleware('auth');

    Route::post('/crearSolicitudEliminar', 'SolicitudEliminarController@crearSolicitudEliminar');

    Route::get('/Actas', 'ActaUsuarioController@homeUsuario')->middleware('auth');

    Route::get('/DetalleUsuario/{id}',['as' => '/DetalleUsuario', 'uses' => 'ActaUsuarioController@DetalleActa'])->middleware('auth');

    Route::post('/queryPersonasUsuario', 'consultaUsuario@query');

    Route::post('/crearActaUsuario', 'ActaUsuarioController@crearActa');

    Route::get('/aceptarSolicitud/{id}', 'CentroNotificacionUsuario@aceptarSolicitud')->middleware('auth');

    Route::get('/centroNotificacion', 'CentroNotificacionUsuario@notificacion')->middleware('auth');

    Route::post('/obtenerSolicitudesUsuario', 'CentroNotificacionUsuario@obtenerSolicitudes')->middleware('auth');

    Route::get('/cambiarContrasenaUser', function () {
        return view('auth.passwords.changeUser');
    })->middleware('auth');

    Route::get('/notificaciones', function () {
        return view('UserViews.notificaciones');
    })->middleware('auth');

});

Route::get('/editarPerfil', 'UserController@index')->middleware('auth');
Route::post('/pdf', 'GenerarPDF@generarPDF' )->middleware('auth');

Route::post('/guardarContrasena', 'UserController@cambiarContrasena');
Route::post('/guardarPerfil', 'UserController@editarPerfilUser');

// Authentication Routes...
Route::post('/login', 'Auth\LoginController@authenticate');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::post('/register', 'Auth\RegisterController@registerForm');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
