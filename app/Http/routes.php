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

Route::group(['prefix'=>'superuser', 'namespace'=>'SuperUser', 'middleware'=>'auth', 'as'=>'superuser'],function(){

    Route::group(['prefix'=>'auditoria', 'namespace'=>'Auditoria', 'as'=>'auditoria'], function(){

    });

    Route::group(['prefix'=>'rol', 'namespace'=>'Rol', 'as'=>'rol'], function(){

    });

    Route::group(['prefix'=>'statustutor', 'namespace'=>'StatusTutor', 'as'=>'statustutor'], function(){

    });

});

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>'auth', 'as'=>'admin'], function(){

    Route::group(['prefix'=>'usuario', 'namespace'=>'Usuario','as'=>'usuario'], function(){

    });

    Route::group(['prefix'=>'sectorproyecto', 'namespace'=>'SectorProyecto', 'as'=>'sectorproyecto'], function(){

    });

    Route::group(['prefix'=>'tecnicaestudio', 'namespace'=>'TecnicaEstudio', 'as'=>'tecnicaestudio'], function(){

    });

    Route::group(['prefix'=>'statustutor', 'namespace'=>'StatusTutor', 'as'=>'statustutor'], function(){

    });


});

Route::group(['prefix'=>'operador', 'namespace'=>'Operador', 'middleware'=>'auth', 'as'=>'operador'],function(){

    Route::group(['prefix'=>'tutor', 'namespace'=>'Tutor', 'as'=>'tutor'], function(){

    });

    Route::group(['prefix'=>'estudiante', 'namespace'=>'Estudiante', 'as'=>'estudiante'], function(){

    });

    Route::group(['prefix'=>'institucion', 'namespace'=>'Institucion', 'as'=>'institucion'], function(){

    });


    Route::group(['prefix'=>'departamento', 'namespace'=>'Departamento', 'as'=>'departamento'], function(){

    });


    Route::group(['prefix'=>'proyecto', 'namespace'=>'Proyecto', 'as'=>'proyecto'], function(){

    });

    Route::group(['prefix'=>'muestra', 'namespace'=>'Muestra','as'=>'muestra'], function(){

    });

});
