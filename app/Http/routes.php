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



Route::get('/login', ['uses' => 'Auth\AuthController@index', 'as' => '/login']);
Route::get('/logout',['uses' => 'Auth\AuthController@getLogout', 'as' => '/logout']);

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'principal']);

Route::auth();

Route::group(['middleware'=>'su', 'prefix'=>'superuser'],function(){

    Route::group(['prefix'=>'auditoria'], function(){

    });
    /**
     * Rutas del rol del usuario, manejadas solo por el superuser
     */
    Route::group(['prefix'=>'rol'], function(){

        Route::get('listar',['uses'=>'RolController@index', 'as'=>'listar']);
        Route::post('register-form',['uses'=>'RolController@renderForm', 'as'=>'register-form']);
        Route::match(array('get','post'),'buscar',['uses'=>'RolController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'brear',['uses'=>'RolController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'bditar/{id}',['uses'=>'RolController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'RolController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-rol',['uses'=>'RolController@ajaxRegularAssign', 'as'=>'asignar-rol']); //hablar con Edward para este metodo
    });

    Route::group(['prefix'=>'estatus-tutor'], function(){

        Route::get('listar',['uses'=>'EstatusTutorController@index', 'as'=>'listar']);
        Route::post('register-form',['uses'=>'EstatusTutorController@renderForm', 'as'=>'register-form']);
        Route::match(array('get','post'),'buscar',['uses'=>'EstatusTutorController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'EstatusTutorController@store', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'EstatusTutorController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'EstatusTutorController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-estatus',['uses'=>'EstatusTutorController@ajaxRegularAssign', 'as'=>'asignar-estatus']); //hablar con Edward para este metodo

    });

    Route::group(['prefix'=>'usuario', 'as'=>'usuario.'], function(){

        Route::get('listar',['uses'=>'UserController@index', 'as'=>'listar']);
        Route::post('register-form',['uses'=>'UserController@renderForm', 'as'=>'register-form']);
        Route::match(array('get','post'),'buscar',['uses'=>'UserController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'UserController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'UserController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'UserController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-rol',['uses'=>'UserController@ajaxRegularAssign', 'as'=>'asignar-rol']); //hablar con Edward para este metodo

    });

});

Route::group(['middleware'=>'admin','prefix' => 'admin'], function(){

    Route::group(['prefix'=>'usuario'], function(){

        Route::get('listar',['uses'=>'UserController@index', 'as'=>'listar']);
        Route::post('register-form',['uses'=>'UserController@renderForm', 'as'=>'register-form']);
        Route::match(array('get','post'),'buscar',['uses'=>'UserController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'UserController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'UserController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'UserController@ajaxRegularDestroy', 'as'=>'eliminar']);
        //Route::post('asignar-rol',['uses'=>'UserController@ajaxRegularAssign', 'as'=>'asignar-rol']); //hablar con Edward para este metodo

    });

    Route::group(['prefix'=>'sector-proyecto'], function(){

        Route::get('listar',['uses'=>'SectorProyectoController@index', 'as'=>'listar']);
        Route::post('register-form',['uses'=>'SectorProyectoController@renderForm', 'as'=>'register-form']);
        Route::match(array('get','post'),'buscar',['uses'=>'SectorProyectoController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'SectorProyectoController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'SectorProyectoController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'SectorProyectoController@ajaxRegularDestroy', 'as'=>'eliminar']);
    });

    Route::group(['prefix'=>'Tecnica-Estudio'], function(){

        Route::get('listar',['uses'=>'TecnicaEstudioController@index', 'as'=>'listar']);
        Route::post('register-form',['uses'=>'TecnicaEstudioController@renderForm', 'as'=>'registerform']);
        Route::match(array('get','post'),'buscar',['uses'=>'TecnicaEstudioController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'TecnicaEstudioController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'TecnicaEstudioController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'TecnicaEstudioController@ajaxRegularDestroy', 'as'=>'eliminar']);
    });

    Route::group(['prefix'=>'statustutor', 'namespace'=>'StatusTutor', 'as'=>'statustutor'], function(){
        Route::post('asignar-rol',['uses'=>'UserController@ajaxRegularAssign', 'as'=>'asignar-rol']);
    });


});

Route::group(['middleware'=>'op', 'prefix' => 'operador'],function(){


    Route::group(['prefix'=>'tutor'], function(){

        Route::get('listar',['uses'=>'TutorController@index', 'as'=>'listar']);
        Route::post('register-form',['uses'=>'TutorController@renderForm', 'as'=>'register-form']);
        Route::match(array('get','post'),'buscar',['uses'=>'TutorController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'TutorController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'TutorController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'TutorController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-tutor-a-departamento',['uses'=>'TutorController@ajaxRegularAssign', 'as'=>'asignar-tutor-a-departamento']);

    });

    Route::group(['prefix'=>'estudiante'], function(){

        Route::get('listar',['uses'=>'EstudianteController@index', 'as'=>'listar']);
        Route::post('register-form',['uses'=>'EstudianteController@renderForm', 'as'=>'register-form']);
        Route::match(array('get','post'),'buscar',['uses'=>'EstudianteController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'EstudianteController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'EstudianteController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'EstudianteController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-estudiante-a-proyecto',['uses'=>'TutorController@ajaxRegularAssign', 'as'=>'asignar-estudiante-a-departamento']);

    });

    Route::group(['prefix'=>'Institucion'], function(){

        Route::get('listar',['uses'=>'InstitucionController@index', 'as'=>'listar']);
        Route::post('registerform',['uses'=>'InstitucionController@renderForm', 'as'=>'register-form']);
        Route::match(array('get','post'),'buscar',['uses'=>'InstitucionController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'InstitucionController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'InstitucionController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'InstitucionController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-institucion-a-proyecto',['uses'=>'InstitucionController@ajaxRegularAssign', 'as'=>'asignar-institucion-a-proyecto']);

    });


    Route::group(['prefix'=>'departamento'], function(){
        Route::get('listar',['uses'=>'DepartamentoController@index', 'as'=>'listar']);
        Route::post('register-form',['uses'=>'DepartamentoController@renderForm', 'as'=>'register-form']);
        Route::match(array('get','post'),'buscar',['uses'=>'DepartamentoController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'DepartamentoController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'DepartamentoController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'DepartamentoController@ajaxRegularDestroy', 'as'=>'eliminar']);
        //Route::post('Asignar-Institucion-A-Proyecto',['uses'=>'DepartamentoController@ajaxRegularAssign', 'as'=>'asignar-institucion-a-proyecto']);
    });


    Route::group(['prefix'=>'proyecto'], function(){

        Route::get('listar',['uses'=>'InstitucionController@index', 'as'=>'listar']);
        Route::post('register-form',['uses'=>'InstitucionController@renderForm', 'as'=>'register-form']);
        Route::match(array('get','post'),'buscar',['uses'=>'InstitucionController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'InstitucionController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'InstitucionController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'InstitucionController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-institucion-A-proyecto',['uses'=>'InstitucionController@ajaxRegularAssign', 'as'=>'asignar-institucion-a-proyecto']);

    });

    Route::group(['prefix'=>'muestra'], function(){

        Route::get('listar',['uses'=>'MuestraController@index', 'as'=>'listar']);
        Route::post('register-form',['uses'=>'MuestraController@renderForm', 'as'=>'registerform']);
        Route::match(array('get','post'),'buscar',['uses'=>'MuestraController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'crear',['uses'=>'MuestraController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'editar/{id}',['uses'=>'MuestraController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('eliminar/{id}',['uses'=>'MuestraController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('asignar-muestra-a-proyecto',['uses'=>'MuestraController@ajaxRegularAssignSample', 'as'=>'asignar-Muestra-a-proyecto']);
        Route::post('asignar-tecnica-a-muestra',['uses'=>'MuestraController@ajaxRegularAssignTechnique', 'as'=>'asignar-tecnica-a-muestra']);

    });

});
