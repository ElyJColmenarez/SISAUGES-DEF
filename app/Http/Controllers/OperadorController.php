<?php

namespace SISAUGES\Http\Controllers;

use Faker\Provider\ar_JO\Person;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use SISAUGES\Http\Requests;
use SISAUGES\Models\Persona;
use SISAUGES\Models\User;
use SISAUGES\Models\RolUsuario;

class OperadorController extends Controller
{



    public function index()
    {


        return view('welcome');

    }


    
}
