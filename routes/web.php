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

Route::get('/', function () {
    return redirect('/login');
    //return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');


Route::group(['prefix' => 'api','middleware' => 'auth'], function () {

    Route::get('/tema', 'RestController@temas');
    Route::get('/temas_enviados/{id_estudiante}/{id_tutor}', 'RestController@temas_enviados');
    Route::get('/tutores', 'RestController@tutores');
    Route::get('/tesistas', 'RestController@tesistas');
    Route::get('/solicitudes', 'RestController@solicitudes');
    Route::get('/buzon', 'RestController@buzon');
    Route::get('/encuentros', 'RestController@encuentros');
    Route::get('/solicitudes_encuentros', 'RestController@solicitudes_encuentros');
    Route::get('/tesistas_jurado', 'RestController@tesistas_jurado');
    Route::get('/observaciones', 'RestController@observaciones');
    Route::get('/observaciones/{id_estudiante}', 'RestController@observaciones_estudiante');
    Route::get('/proyectos', 'RestController@proyectos');
    Route::get('/jurados', 'RestController@jurados');
    Route::get('/solicitudes_jurados', 'RestController@solicitudes_jurados');
    Route::get('/resultados_tutor/{request}', 'RestController@resultados_tutor');
    Route::get('/resultados_jurado/{request}', 'RestController@resultados_jurado');
});



Route::group(['prefix' => 'solicitar_tutor','middleware' => 'auth'], function () {
    Route::get('/', 'SolicitudTutor@solicitar_tutor')->name('solicitar_tutor')->middleware(es_estudiante::class);
    Route::get('/solicitudes', 'SolicitudTutor@solicitudes_estudiantes')->name('solicitudes_estudiantes')->middleware(es_tutor::class);
    Route::get('/enviar/{id_tutor}', 'SolicitudTutor@enviar_tutor')->name('enviar_solicitud_tutor')->middleware(es_estudiante::class);
    Route::get('/responder/{id_solicitud}', 'SolicitudTutor@responder_solicitud')->name('responder_solicitud_estudiante')->middleware(es_tutor::class);
    Route::post('/enviar/{id_tutor}', 'SolicitudTutor@guardar_solicitud')->name('guardar_solicitud')->middleware(es_estudiante::class);
    Route::post('/responder/{id_solicitud}', 'SolicitudTutor@guardar_solicitud_estudiante')->name('guardar_solicitud_estuidante')->middleware(es_tutor::class);
    Route::get('/ver/{id_solicitud}', 'SolicitudTutor@ver_solicitar_tutor')->name('ver_solicitud_tutor');
});


Route::group(['prefix' => 'tema','middleware' => 'auth'], function () {
    Route::get('/lista_estudiantes/{id_tutor}', 'TemaTesis@lista_estudiantes')->name('seleccionar_estudiante')->middleware(es_tutor::class);
    Route::get('/enviar/{id_estudiante}/{id_tutor}', 'TemaTesis@enviar_tema')->name('enviar_tema')->middleware(es_tutor::class);
    Route::post('/enviar/{id_estudiante}/{id_tutor}', 'TemaTesis@guardar_tema')->name('guardar_tema')->middleware(es_tutor::class);
    Route::get('/ver/', 'TemaTesis@ver_tema')->name('tema_ver')->middleware(es_estudiante::class);
    Route::get('/ver_detalle/{tema_id}', 'TemaTesis@ver_detalle')->name('tema_ver_detalle')->middleware(es_tutor::class);
    Route::get('/responder/{tema_id}', 'TemaTesis@responder_tema')->name('tema_responder')->middleware(es_estudiante::class);
    Route::post('/responder/{tema_id}', 'TemaTesis@respondido_tema')->name('tema_respondido')->middleware(es_estudiante::class);
});
Route::group(['prefix' => 'encuentros','middleware' => 'auth'], function () {
    Route::get('/solicitar/', 'SolicitarEncuentros@solicitar_encuentro')->name('solicitar_encuentro')->middleware(es_estudiante::class);
    Route::get('/ver/{id_encuentro}', 'SolicitarEncuentros@ver_encuentro')->name('encuentro_ver');
    Route::post('/solicitar', 'SolicitarEncuentros@encuentro_solicitado')->name('encuentro_solicitado')->middleware(es_estudiante::class);
    Route::get('/estudiantes', 'SolicitarEncuentros@lista_estudiantes')->name('encuentros_estudiantes')->middleware(es_tutor::class);
    Route::get('/lista', 'SolicitarEncuentros@lista_encuentros')->name('lista_encuentros')->middleware(es_estudiante::class);
    Route::get('/responder/{id_encuentro}', 'SolicitarEncuentros@responder_encuentro')->name('encuentro_responder')->middleware(es_tutor::class);
    Route::post('/responder/{id_encuentro}', 'SolicitarEncuentros@respondido_encuentro')->name('encuentro_respondido')->middleware(es_tutor::class);
});
Route::group(['prefix' => 'observaciones','middleware' => 'auth'], function () {
    Route::get('/', 'Observacion@observacion_estudiante')->name('observaciones')->middleware(es_estudiante::class);
    Route::get('/lista/', 'Observacion@lista_estudiantes')->name('observaciones_lista_estudiantes')->middleware(es_tutor::class);
    Route::get('/ver_estudiante/{id_estudiante}', 'Observacion@ver_observaciones_estudiante')->name('ver_observaciones_estudiante')->middleware(es_tutor::class);
    Route::get('/realizar_estudiante/{id_estudiante}', 'Observacion@realizar_observaciones_estudiante')->name('realizar_observaciones_estudiante')->middleware(es_tutor::class);
    Route::post('/realizar_estudiante/{id_estudiante}', 'Observacion@guardar_observaciones_estudiante')->name('guardar_observaciones_estudiante')->middleware(es_tutor::class);
    Route::get('/ver/{id_observacion}', 'Observacion@ver_observacion')->name('ver_observacion');
});

Route::group(['prefix' => 'proyecto','middleware' => 'auth'], function () {
    Route::get('/adjuntar', 'Proyectos@adjuntar')->name('proyecto_adjuntar')->middleware(es_estudiante::class);
    Route::post('/adjuntar', 'Proyectos@guardar')->name('proyecto_guardar')->middleware(es_estudiante::class);
    Route::get('/ver', 'Proyectos@ver')->name('proyecto_ver');
    Route::get('/estudiantes', 'Proyectos@estudiantes')->name('proyecto_estudiantes')->middleware(es_tutor::class);
    Route::get('/estudiante_ver/{id_estudiante}', 'Proyectos@estudiante_ver')->name('proyecto_estudiante_ver')->middleware(es_tutor::class);
});

Route::group(['prefix' => 'jurado','middleware' => 'auth'], function () {

    Route::get('/lista/', 'SolicitarJurado@lista_estudiantes')->name('jurado_lista_estudiantes')->middleware(es_tutor::class);
    Route::get('/realizar_solicitud/{id_estudiante}', 'SolicitarJurado@realizar_solicitud_estudiante')->name('realizar_solicitud_estudiante')->middleware(es_tutor::class);
    Route::post('/realizar_solicitud/{id_estudiante}', 'SolicitarJurado@guardar_solicitud_estudiante')->name('guardar_solicitud_estudiante')->middleware(es_tutor::class);
    Route::get('/ver_solicitud_jurado/{id_estudiante}', 'SolicitarJurado@ver_solicitud_jurado')->name('ver_solicitud_jurado_estudiante')->middleware(es_tutor::class);
    Route::get('/ver_solicitud_jurado_secretaria/', 'SolicitarJurado@ver_solicitud_jurado_secretaria')->name('ver_solicitud_jurado_secretaria')->middleware(es_secretaria::class);
    Route::get('/detalle_solicitud_jurado/{id_solicitud}', 'SolicitarJurado@detalle_solicitud_jurado')->name('detalle_solicitud_jurado')->middleware(es_secretaria::class);
    Route::get('/lista_registro', 'SolicitarJurado@lista_registrar_jurado')->name('lista_registrar_jurado')->middleware(es_secretaria::class);
    Route::get('/registrar/{id_solicitud}', 'SolicitarJurado@registrar_jurado')->name('registrar_jurado')->middleware(es_secretaria::class);
    Route::post('/registrar/{id_solicitud}', 'SolicitarJurado@guardar_jurado')->name('guardar_jurado')->middleware(es_secretaria::class);
    Route::get('/jurado_asignado/{id_solicitud_jurado}', 'SolicitarJurado@jurado_asignado')->name('jurado_asignado')->middleware(es_secretaria::class);
    Route::get('/ver_jurado/', 'SolicitarJurado@ver_jurado_estudiante')->name('ver_jurado_estudiante')->middleware(es_estudiante::class);
    Route::get('/lista_estudiantes_jurado/', 'SolicitarJurado@lista_estudiantes_jurado')->name('lista_estudiantes_jurado')->middleware(es_tutor::class);
    Route::get('/ver_jurado_tutor/{id_estudiante}', 'SolicitarJurado@ver_jurado_estudiante_tutor')->name('ver_jurado_estudiante_tutor')->middleware(es_tutor::class);

});


Route::group(['prefix' => 'evaluacion','middleware' => 'auth'], function () {

    Route::get('/lista/', 'Evaluaciones@lista_registrar_evaluacion')->name('lista_registrar_evaluacion')->middleware(es_secretaria::class);
    Route::get('/registrar/{id_solicitud_jurado}', 'Evaluaciones@registrar_evaluacion')->name('registrar_evaluacion')->middleware(es_secretaria::class);
    Route::post('/registrar/{id_solicitud_jurado}', 'Evaluaciones@guardar_evaluacion')->name('guardar_evaluacion')->middleware(es_secretaria::class);
    Route::get('/ver/{id_solicitud_jurado}', 'Evaluaciones@ver_evaluacion')->name('ver_evaluacion')->middleware(es_secretaria::class);
    Route::get('/ver_evaluacion/', 'Evaluaciones@ver_evaluacion_estudiante')->name('ver_evaluacion_estudiante')->middleware(es_estudiante::class);
    Route::get('/ver_evaluacion_tutor/{id_estudiante}', 'Evaluaciones@ver_evaluacion_estudiante_tutor')->name('ver_evaluacion_estudiante_tutor')->middleware(es_tutor::class);
    Route::get('/lista_estudiantes_evaluacion/', 'Evaluaciones@lista_estudiantes_evaluacion')->name('lista_estudiantes_evaluacion')->middleware(es_tutor::class);
});

Route::group(['prefix' => 'reportes','middleware' => 'auth'], function () {

    Route::get('/seleccionar_tutor', 'Reportes@seleccionar_tutor')->name('seleccionar_tutor')->middleware(es_secretaria::class);
    Route::post('/seleccionar_tutor', 'Reportes@resultados_tutor')->name('resultados_tutor')->middleware(es_secretaria::class);
    Route::get('/solicitud_tutor/{id_proyecto}/{id_tutor}', 'Reportes@solicitud_tutor')->name('r_solicitud_tutor')->middleware(es_secretaria::class);
    Route::get('/seleccionar_estudiante', 'Reportes@seleccionar_estudiante')->name('r_seleccionar_estudiante')->middleware(es_secretaria::class);
    Route::post('/seleccionar_estudiante', 'Reportes@resultados_estudiante')->name('resultados_estudiante')->middleware(es_secretaria::class);
    Route::get('/seleccionar_jurado', 'Reportes@seleccionar_jurado')->name('seleccionar_jurado')->middleware(es_secretaria::class);
    Route::post('/seleccionar_jurado', 'Reportes@resultados_jurado')->name('resultados_jurado')->middleware(es_secretaria::class);
    Route::get('/jurado_detalles/{solicitud_jurado_id}/{jurado_id}/{proyecto_id}', 'Reportes@reporte_jurado_detalles')->name('reporte_jurado_detalles')->middleware(es_secretaria::class);

});


