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



Route::get('/', ['uses' => 'Auth\AuthController@index', 'as' => '/']);


Route::auth();

Route::group(['prefix'=>'superuser', 'namespace'=>'SuperUser', 'middleware'=>'su', 'as'=>'superuser'],function(){

    Route::group(['prefix'=>'auditoria', 'namespace'=>'Auditoria', 'as'=>'auditoria'], function(){

    });
    /**
     * Rutas del rol del usuario, manejadas solo por el superuser
     */
    Route::group(['prefix'=>'rol', 'namespace'=>'Rol', 'as'=>'rol'], function(){

        Route::get('Listar',['uses'=>'RolController@index', 'as'=>'listar']);
        Route::post('RegisterForm',['uses'=>'RolController@renderForm', 'as'=>'registerform']);
        Route::post('Buscar',['uses'=>'RolController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'Crear',['uses'=>'RolController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'Editar/{id}',['uses'=>'RolController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('Eliminar/{id}',['uses'=>'RolController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('Asignar-Rol',['uses'=>'RolController@ajaxRegularAssign', 'as'=>'asignar-rol']); //hablar con Edward para este metodo
    });

    Route::group(['prefix'=>'estatustutor', 'namespace'=>'EstatusTutor', 'as'=>'estatustutor'], function(){

        Route::get('Listar',['uses'=>'EstatusTutorController@index', 'as'=>'listar']);
        Route::post('RegisterForm',['uses'=>'EstatusTutorController@renderForm', 'as'=>'registerform']);
        Route::post('Buscar',['uses'=>'EstatusTutorController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'Crear',['uses'=>'EstatusTutorController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'Editar/{id}',['uses'=>'EstatusTutorController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('Eliminar/{id}',['uses'=>'EstatusTutorController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('Asignar-Estatus',['uses'=>'EstatusTutorController@ajaxRegularAssign', 'as'=>'asignar-estatus']); //hablar con Edward para este metodo

    });

    Route::group(['prefix'=>'usuario', 'namespace'=>'Usuario','as'=>'usuario'], function(){

        Route::get('Listar',['uses'=>'UserController@index', 'as'=>'listar']);
        Route::post('RegisterForm',['uses'=>'UserController@renderForm', 'as'=>'registerform']);
        Route::post('Buscar',['uses'=>'UserController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'Crear',['uses'=>'UserController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'Editar/{id}',['uses'=>'UserController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('Eliminar/{id}',['uses'=>'UserController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('Asignar-Rol',['uses'=>'UserController@ajaxRegularAssign', 'as'=>'asignar-rol']); //hablar con Edward para este metodo

    });

});

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>'admin', 'as'=>'admin'], function(){

    Route::group(['prefix'=>'usuario', 'namespace'=>'Usuario','as'=>'usuario'], function(){

        Route::get('Listar',['uses'=>'UserController@index', 'as'=>'listar']);
        Route::post('RegisterForm',['uses'=>'UserController@renderForm', 'as'=>'registerform']);
        Route::post('Buscar',['uses'=>'UserController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'Crear',['uses'=>'UserController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'Editar/{id}',['uses'=>'UserController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('Eliminar/{id}',['uses'=>'UserController@ajaxRegularDestroy', 'as'=>'eliminar']);
        //Route::post('Asignar-Rol',['uses'=>'UserController@ajaxRegularAssign', 'as'=>'asignar-rol']); //hablar con Edward para este metodo

    });

    Route::group(['prefix'=>'sectorproyecto', 'namespace'=>'SectorProyecto', 'as'=>'sectorproyecto'], function(){

        Route::get('Listar',['uses'=>'SectorProyectoController@index', 'as'=>'listar']);
        Route::post('RegisterForm',['uses'=>'SectorProyectoController@renderForm', 'as'=>'registerform']);
        Route::post('Buscar',['uses'=>'SectorProyectoController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'Crear',['uses'=>'SectorProyectoController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'Editar/{id}',['uses'=>'SectorProyectoController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('Eliminar/{id}',['uses'=>'SectorProyectoController@ajaxRegularDestroy', 'as'=>'eliminar']);
    });

    Route::group(['prefix'=>'tecnicaestudio', 'namespace'=>'TecnicaEstudio', 'as'=>'tecnicaestudio'], function(){

        Route::get('Listar',['uses'=>'TecnicaEstudioController@index', 'as'=>'listar']);
        Route::post('RegisterForm',['uses'=>'TecnicaEstudioController@renderForm', 'as'=>'registerform']);
        Route::post('Buscar',['uses'=>'TecnicaEstudioController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'Crear',['uses'=>'TecnicaEstudioController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'Editar/{id}',['uses'=>'TecnicaEstudioController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('Eliminar/{id}',['uses'=>'TecnicaEstudioController@ajaxRegularDestroy', 'as'=>'eliminar']);
    });

    Route::group(['prefix'=>'statustutor', 'namespace'=>'StatusTutor', 'as'=>'statustutor'], function(){
        Route::post('Asignar-Rol',['uses'=>'UserController@ajaxRegularAssign', 'as'=>'asignar-rol']);
    });


});

Route::group(['prefix'=>'operador', 'namespace'=>'Operador', 'middleware'=>'op', 'as'=>'operador'],function(){

    Route::group(['prefix'=>'tutor', 'namespace'=>'Tutor', 'as'=>'tutor'], function(){

        Route::get('Listar',['uses'=>'TutorController@index', 'as'=>'listar']);
        Route::post('RegisterForm',['uses'=>'TutorController@renderForm', 'as'=>'registerform']);
        Route::post('Buscar',['uses'=>'TutorController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'Crear',['uses'=>'TutorController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'Editar/{id}',['uses'=>'TutorController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('Eliminar/{id}',['uses'=>'TutorController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('Asignar-Tutor-A-Departamento',['uses'=>'TutorController@ajaxRegularAssign', 'as'=>'asignar-tutor-a-departamento']);

    });

    Route::group(['prefix'=>'estudiante', 'namespace'=>'Estudiante', 'as'=>'estudiante'], function(){

        Route::get('Listar',['uses'=>'EstudianteController@index', 'as'=>'listar']);
        Route::post('RegisterForm',['uses'=>'EstudianteController@renderForm', 'as'=>'registerform']);
        Route::post('Buscar',['uses'=>'EstudianteController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'Crear',['uses'=>'EstudianteController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'Editar/{id}',['uses'=>'EstudianteController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('Eliminar/{id}',['uses'=>'EstudianteController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('Asignar-Estudiante-A-Proyecto',['uses'=>'TutorController@ajaxRegularAssign', 'as'=>'asignar-estudiante-a-departamento']);

    });

    Route::group(['prefix'=>'institucion', 'namespace'=>'Institucion', 'as'=>'institucion'], function(){

        Route::get('Listar',['uses'=>'InstitucionController@index', 'as'=>'listar']);
        Route::post('RegisterForm',['uses'=>'InstitucionController@renderForm', 'as'=>'registerform']);
        Route::post('Buscar',['uses'=>'InstitucionController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'Crear',['uses'=>'InstitucionController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'Editar/{id}',['uses'=>'InstitucionController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('Eliminar/{id}',['uses'=>'InstitucionController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('Asignar-Institucion-A-Proyecto',['uses'=>'InstitucionController@ajaxRegularAssign', 'as'=>'asignar-institucion-a-proyecto']);

    });


    Route::group(['prefix'=>'departamento', 'namespace'=>'Departamento', 'as'=>'departamento'], function(){
        Route::get('Listar',['uses'=>'DepartamentoController@index', 'as'=>'listar']);
        Route::post('RegisterForm',['uses'=>'DepartamentoController@renderForm', 'as'=>'registerform']);
        Route::post('Buscar',['uses'=>'DepartamentoController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'Crear',['uses'=>'DepartamentoController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'Editar/{id}',['uses'=>'DepartamentoController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('Eliminar/{id}',['uses'=>'DepartamentoController@ajaxRegularDestroy', 'as'=>'eliminar']);
        //Route::post('Asignar-Institucion-A-Proyecto',['uses'=>'DepartamentoController@ajaxRegularAssign', 'as'=>'asignar-institucion-a-proyecto']);
    });


    Route::group(['prefix'=>'proyecto', 'namespace'=>'Proyecto', 'as'=>'proyecto'], function(){

        Route::get('Listar',['uses'=>'InstitucionController@index', 'as'=>'listar']);
        Route::post('RegisterForm',['uses'=>'InstitucionController@renderForm', 'as'=>'registerform']);
        Route::post('Buscar',['uses'=>'InstitucionController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'Crear',['uses'=>'InstitucionController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'Editar/{id}',['uses'=>'InstitucionController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('Eliminar/{id}',['uses'=>'InstitucionController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('Asignar-Institucion-A-Proyecto',['uses'=>'InstitucionController@ajaxRegularAssign', 'as'=>'asignar-institucion-a-proyecto']);

    });

    Route::group(['prefix'=>'muestra', 'namespace'=>'Muestra','as'=>'muestra'], function(){

        Route::get('Listar',['uses'=>'MuestraController@index', 'as'=>'listar']);
        Route::post('RegisterForm',['uses'=>'MuestraController@renderForm', 'as'=>'registerform']);
        Route::post('Buscar',['uses'=>'MuestraController@renderForm', 'as'=>'buscar']);
        Route::match(array('get','post'),'Crear',['uses'=>'MuestraController@ajaxRegularStore', 'as'=>'crear']);
        Route::match(array('get','post'),'Editar/{id}',['uses'=>'MuestraController@ajaxRegularUpdate', 'as'=>'editar']);
        Route::post('Eliminar/{id}',['uses'=>'MuestraController@ajaxRegularDestroy', 'as'=>'eliminar']);
        Route::post('Asignar-Muestra-A-Proyecto',['uses'=>'MuestraController@ajaxRegularAssignSample', 'as'=>'asignar-Muestra-a-proyecto']);
        Route::post('Asignar-Tecnica-A-Muestra',['uses'=>'MuestraController@ajaxRegularAssignTechnique', 'as'=>'asignar-tecnica-a-muestra']);

    });

});
