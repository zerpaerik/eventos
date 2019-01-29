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

});
    
    Route::get('/confirmar/index1','ConfirmarController@index1')->name('admin.confirmar.index1');


    Route::get('/users/locbyemp/{id}','Admin\UsersController@locbyemp');
    Route::get('/pacientes/distbypro/{id}','Archivos\PacientesController@distbypro');



/////// RUTAS DE PACIENTES  ////


    Route::get('/pacientes', function () {return view('pacientes.create');});
    Route::get('/pacientes/create','Archivos\PacientesController@create');
    Route::get('/archivos/pacientes/createmodal', ['uses' => 'Archivos\PacientesController@createmodal', 'as' => 'pacientes.createmodal']);
    Route::post('/pacientes/store', ['uses' => 'Archivos\PacientesController@store', 'as' => 'pacientes.store']);
    Route::post('/pacientes/store2', ['uses' => 'Archivos\PacientesController@store2', 'as' => 'pacientes.store2']);
    Route::get('/pacientes/index',['uses' => 'Archivos\PacientesController@index', 'as' => 'pacientes.index']);
    Route::get('/pacientes/edit/{id}',['uses' => 'Archivos\PacientesController@edit', 'as' => 'pacientes.edit']);
    Route::get('/pacientes/ver/{id}',['uses' => 'Archivos\PacientesController@ver', 'as' => 'pacientes.ver']);
    Route::put('/pacientes/update/{id}',['uses' => 'Archivos\PacientesController@update', 'as' => 'pacientes.update']);
    Route::put('/pacientes/destroy/{id}',['uses' => 'Archivos\PacientesController@destroy', 'as' => 'pacientes.destroy']);
  //  Route::get('/atencion/editar/{id}',['uses' => 'Archivos\PacientesController@edit', 'as' => 'pacientes.edit']);


 Route::put('/comisionesporpagar/destroylab/{id}',['uses' => 'Existencias\ComisionesPorPagarController@destroylab', 'as' => 'comisionesporpagar.destroylab']);



   Route::get('/existencias/atencion/cardainput/{id}','Existencias\AtencionController@cardainput');
   Route::get('/existencias/atencion/cardainput2/{id}','Existencias\AtencionController@cardainput2');
   Route::get('/existencias/atencion/cardainput3/{id}','Existencias\AtencionController@cardainput3');

   Route::get('/movimientos/productos/index2','Movimientos\ProductosController@index2')->name('admin.productos.index2');


   Route::get('/indexFecha/{fecha}','Existencias\AtencionController@indexFecha');
   Route::get('/selectproduct/{id}','Existencias\AtencionController@selectproduct');

   Route::get('createmodal','Archivos\PacientesController@createmodal');
   Route::get('/total','Reportes\PdfController@totalDiario');

  Route::get('reportes/index','PdfController@index');
  Route::get('listado_atenciondiaria_ver','Reportes\PdfController@listado_atenciondiaria_ver')->name('listado_atenciondiaria_ver');
  Route::get('/historia_pacientes_ver/{id}','Reportes\PdfController@historia_pacientes_ver');
  Route::get('/recibo_profesionales_ver/{id}','Reportes\PdfController@recibo_profesionales_ver');
  Route::get('/resultados_ver/{id}','Reportes\PdfController@resultados_ver')->name('resultados');
  Route::get('/resultados_lab_ver/{id}','Reportes\PdfController@resultados_lab_ver')->name('resultados_lab');
  Route::get('/resultados_lab_paq_ver/{id}','Reportes\PdfController@resultados_lab_paq_ver')->name('resultados_lab_paq');
  Route::get('/resultados_lab_paq_serv_ver/{id}','Reportes\PdfController@resultados_lab_paq_serv')->name('resultados_lab_paq_serv');


  Route::get('/ticket_atencion_ver/{id}','Reportes\PdfController@ticket_atencion_ver');

  Route::get('/existencias/cuentasporcobrar/pagar/{id}', ['uses' => 'Existencias\CuentasporCobrarController@pagar', 'as' => 'admin.cuentasporcobrar.pagar']);



    Route::get('/prueba','Existencias\AtencionController@prueba');
    Route::put('destroylab', 'Existencias\ComisionesPorPagarController@destroylab')->name('admin.comisionesporpagar.destroylab');



  
    Route::group(['prefix' => 'reportes'], function () {
        Route::post('reportegeneral', 'ReportesController@reportegeneral');
        Route::get('filtro-general', 'ReportesController@filtrogeneral')->name('filtros');


        
    });



     Route::get('pacientesreport', 'ReportesController@pacientes');
     Route::get('serviciosreport', 'ReportesController@servicios');
     Route::get('analisisreport', 'ReportesController@analisis');
     Route::get('reportes', 'ReportesController@index')->name('reportes');


