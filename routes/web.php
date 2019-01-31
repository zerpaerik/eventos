<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('abilities', 'Admin\AbilitiesController');
    Route::post('abilities_mass_destroy', ['uses' => 'Admin\AbilitiesController@massDestroy', 'as' => 'abilities.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);


    Route::resource('clientes', 'ClientesController');
    Route::post('clientes_mass_destroy', ['uses' => 'ClientesController@massDestroy', 'as' => 'clientes.mass_destroy']);

     Route::resource('clientese', 'ClienteseController');
    Route::post('clientese_mass_destroy', ['uses' => 'ClienteseController@massDestroy', 'as' => 'clientese.mass_destroy']);

    Route::resource('eventos', 'EventosController');
    Route::post('eventos_mass_destroy', ['uses' => 'EventosController@massDestroy', 'as' => 'eventos.mass_destroy']);

      Route::resource('llamados', 'LlamadosController');
    Route::post('llamados_mass_destroy', ['uses' => 'LlamadosController@massDestroy', 'as' => 'llamados.mass_destroy']);


    Route::resource('confirmar', 'ConfirmarController');
    Route::post('confirmar_mass_destroy', ['uses' => 'ConfirmarController@massDestroy', 'as' => 'confirmar.mass_destroy']);

    Route::resource('empresas', 'Admin\EmpresasController');
    Route::post('empresas_mass_destroy', ['uses' => 'Archivos\EmpresasController@massDestroy', 'as' => 'empresas.mass_destroy']);

     Route::resource('pagos', 'PagosController');
    Route::post('pagos_mass_destroy', ['uses' => 'PagosController@massDestroy', 'as' => 'pagos.mass_destroy']);

        Route::resource('asistencia', 'AsistenciaController');
    Route::post('asistencia_mass_destroy', ['uses' => 'AsistenciaController@massDestroy', 'as' => 'asistencia.mass_destroy']);

});
    Route::get('/clientes/index1','ClientesController@index1')->name('admin.clientes.index1');
    Route::get('/clientes-llamar-{id}','ClientesController@llamar');

    Route::get('/llamados/index1','LlamadosController@index1')->name('admin.llamados.index1');
    Route::get('/confirmar/index1','ConfirmarController@index1')->name('admin.confirmar.index1');

        Route::get('/asistencia/index1','AsistenciaController@index1')->name('admin.asistencia.index1');



    

  Route::get('reportes/llamadas','ReportesController@llamadas')->name('index.llamadas');
  Route::get('reportes/ingresos','ReportesController@ingresos')->name('index.ingresos');
  Route::get('reportes/asistentes','ReportesController@asistentes')->name('index.asistentes');

  Route::get('listado_llamadas','ReportesController@listado_llamadas_ver')->name('listado_llamadas_ver');
  Route::get('listado_ingresos','ReportesController@listado_ingresos_ver')->name('listado_ingresos_ver');
  Route::get('listado_asistentes','ReportesController@listado_asistentes_ver')->name('listado_asistentes_ver');




  Route::get('listado_atenciondiaria_ver','Reportes\PdfController@listado_atenciondiaria_ver')->name('listado_atenciondiaria_ver');
  Route::get('/historia_pacientes_ver/{id}','Reportes\PdfController@historia_pacientes_ver');
  Route::get('/recibo_profesionales_ver/{id}','Reportes\PdfController@recibo_profesionales_ver');
  Route::get('/resultados_ver/{id}','Reportes\PdfController@resultados_ver')->name('resultados');
  Route::get('/resultados_lab_ver/{id}','Reportes\PdfController@resultados_lab_ver')->name('resultados_lab');
  Route::get('/resultados_lab_paq_ver/{id}','Reportes\PdfController@resultados_lab_paq_ver')->name('resultados_lab_paq');
  Route::get('/resultados_lab_paq_serv_ver/{id}','Reportes\PdfController@resultados_lab_paq_serv')->name('resultados_lab_paq_serv');



