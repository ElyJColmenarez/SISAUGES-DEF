<?php



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/logout',['uses' => 'Auth\AuthController@getLogout', 'as' => '/logout']);
Route::auth();
Route::get('/login', ['uses' => 'Auth\AuthController@index', 'as' => '/login']);
Route::get('/', ['uses' => 'HomeController@index', 'as' => 'principal']);




Route::group(['middleware'=>'auditoria'],function(){

    Route::group(['prefix'=>'auditoria'], function(){

        Route::match(array('get','post'),'listar',['uses'=>'AuditoriaController@index', 'as'=>'listar']);

    });

});

Route::group(['middleware'=>'admin'], function(){

     Route::group(['prefix'=>'usuario', 'as'=>'usuario.'], function(){

        Route::match(array('get','post'),'listar',['uses'=>'UserController@index', 'as'=>'listar']);
        Route::post('registerform',['uses'=>'UserController@renderForm', 'as'=>'registerform']);
        Route::match(array('get','post'),'buscar',['uses'=>'UserController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'UserController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'UserController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'UserController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-rol',['uses'=>'UserController@ajaxRegularAssign', 'as'=>'asignar-rol']); //hablar con Edward para este metodo

    });


    Route::group(['prefix'=>'estatus-tutor'], function(){

        Route::match(array('get','post'),'listar',['uses'=>'EstatusTutorController@index', 'as'=>'listar']);
        Route::post('registerform',['uses'=>'EstatusTutorController@renderForm', 'as'=>'registerform']);
        Route::match(array('get','post'),'buscar',['uses'=>'EstatusTutorController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'EstatusTutorController@store', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'EstatusTutorController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'EstatusTutorController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-estatus',['uses'=>'EstatusTutorController@ajaxRegularAssign', 'as'=>'asignar-estatus']); //hablar con Edward para este metodo

    });

});

Route::group(['middleware'=>'op'],function(){


    Route::group(['prefix'=>'tutor'], function(){

        Route::match(array('get','post'),'listar',['uses'=>'TutorController@index', 'as'=>'listar']);
        Route::post('registerform',['uses'=>'TutorController@renderForm', 'as'=>'registerform']);
        Route::match(array('get','post'),'buscar',['uses'=>'TutorController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'TutorController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'TutorController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'TutorController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-tutor-a-departamento',['uses'=>'TutorController@ajaxRegularAssign', 'as'=>'asignar-tutor-a-departamento']);
    });

    Route::group(['prefix'=>'estudiante'], function(){
        Route::match(array('get','post'),'listar',['uses'=>'EstudianteController@index', 'as'=>'listar']);
        Route::post('registerform',['uses'=>'EstudianteController@renderForm', 'as'=>'registerform']);
        Route::match(array('get','post'),'buscar',['uses'=>'EstudianteController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'EstudianteController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'EstudianteController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'EstudianteController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-estudiante-a-proyecto',['uses'=>'TutorController@ajaxRegularAssign', 'as'=>'asignar-estudiante-a-departamento']);

    });

    Route::group(['prefix'=>'institucion'], function(){
        Route::match(array('get','post'),'listar',['uses'=>'InstitucionController@index', 'as'=>'listar']);
        Route::post('registerform',['uses'=>'InstitucionController@renderForm', 'as'=>'registerform']);
        Route::match(array('get','post'),'buscar',['uses'=>'InstitucionController@ajaxRegularSearch', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'InstitucionController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'InstitucionController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'InstitucionController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-institucion-a-proyecto',['uses'=>'InstitucionController@ajaxRegularAssign', 'as'=>'asignar-institucion-a-proyecto']);

    });

    Route::group(['prefix'=>'departamento'], function(){
        Route::match(array('get','post'),'listar',['uses'=>'DepartamentoController@index', 'as'=>'listar']);      
        Route::post('registerform',['uses'=>'DepartamentoController@renderForm', 'as'=>'registerform']);
        Route::match(array('get','post'),'buscar',['uses'=>'DepartamentoController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'DepartamentoController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'DepartamentoController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'DepartamentoController@ajaxRegularDestroy', 'as'=>'eliminar']);
    
    }); 

    Route::group(['prefix'=>'laboratorio'], function(){
        Route::match(array('get','post'),'listar',['uses'=>'LaboratorioController@index', 'as'=>'listar']);      
        Route::post('registerform',['uses'=>'LaboratorioController@renderForm', 'as'=>'registerform']);
        Route::match(array('get','post'),'buscar',['uses'=>'LaboratorioController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'LaboratorioController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'LaboratorioController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'LaboratorioController@ajaxRegularDestroy', 'as'=>'eliminar']);
    });

    Route::group(['prefix'=>'tecnica-estudio'], function(){

        Route::match(array('get','post'),'listar',['uses'=>'TecnicaEstudioController@index', 'as'=>'listar']);   
        Route::post('registerform',['uses'=>'TecnicaEstudioController@renderForm', 'as'=>'registerform']);
        Route::match(array('get','post'),'buscar',['uses'=>'TecnicaEstudioController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'TecnicaEstudioController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'TecnicaEstudioController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'TecnicaEstudioController@ajaxRegularDestroy', 'as'=>'eliminar']);
    });


    Route::group(['prefix'=>'tipo-muestra'], function(){

        Route::match(array('get','post'),'listar',['uses'=>'TipoMuestraController@index', 'as'=>'listar']);
        Route::post('registerform',['uses'=>'TipoMuestraController@renderForm', 'as'=>'registerform']);
        Route::match(array('get','post'),'buscar',['uses'=>'TipoMuestraController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'TipoMuestraController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'TipoMuestraController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'TipoMuestraController@ajaxRegularDestroy', 'as'=>'eliminar']);
    });



    Route::group(['prefix'=>'proyecto'], function(){

        Route::match(array('get','post'),'listar',['uses'=>'ProyectoController@index', 'as'=>'listar']);
        Route::post('registerform',['uses'=>'ProyectoController@renderForm', 'as'=>'registerform']);
        Route::match(array('get','post'),'buscar',['uses'=>'ProyectoController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'ProyectoController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'ProyectoController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'ProyectoController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-institucion-A-proyecto',['uses'=>'ProyectoController@ajaxRegularAssign', 'as'=>'asignar-institucion-a-proyecto']);

    });

    Route::group(['prefix'=>'muestra'], function(){

        Route::match(array('get','post'),'listar',['uses'=>'MuestraController@index', 'as'=>'listar']);
        Route::post('registerform',['uses'=>'MuestraController@renderForm', 'as'=>'registerform']);
        Route::match(array('get','post'),'buscar',['uses'=>'MuestraController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'MuestraController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'MuestraController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'MuestraController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-muestra-a-proyecto',['uses'=>'MuestraController@ajaxRegularAssignSample', 'as'=>'asignar-Muestra-a-proyecto']);
        Route::post('asignar-tecnica-a-muestra',['uses'=>'MuestraController@ajaxRegularAssignTechnique', 'as'=>'asignar-tecnica-a-muestra']);

        Route::match(array('get','post'),'report/{field_id}',['uses'=>'MuestraController@descargaMuestra', 'as'=>'report']);

    });

});

Route::group(['middleware'=>'visitante', 'prefix' => 'visitante'],function()
{

    Route::group(['prefix'=>'muestra'], function()
    {
        Route::match(array('get','post'),'listar',['uses'=>'MuestraController@index', 'as'=>'listar']);
        Route::post('registerform',['uses'=>'MuestraController@renderForm', 'as'=>'registerform']);
        Route::match(array('get','post'),'report/{field_id}',['uses'=>'MuestraController@descargaMuestra', 'as'=>'report']);
    });

    Route::group(['prefix'=>'proyecto'], function()
    {
        Route::match(array('get', 'post'), 'listar', ['uses' => 'ProyectoController@index', 'as' => 'listar']);
        Route::post('registerform',['uses'=>'ProyectoController@renderForm', 'as'=>'registerform']);
    });
});

