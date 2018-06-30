<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;

class AdministrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the administration for convenios
     *
     * @return \Illuminate\Http\Response
     */
    public function convenios(){

    }

    /**
     * Show the administration for convenios
     *
     * @return \Illuminate\Http\Response
     */
    public function contratos(){

    }
}
