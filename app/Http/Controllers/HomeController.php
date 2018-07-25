<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agreements_config;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convenios = DB::select('SELECT * FROM `agreements` a
            inner join agreements_config c on c.agreement = a.id
            inner join configs con on con.id = c.config
            inner join agreements_types a_t on a_t.id = con.agreement_type
            where a_t.id = :agreement_type', ['agreement_type' => 1]);

        $convenios = count($convenios);


        $contratos = DB::select('SELECT * FROM `agreements` a
            inner join agreements_config c on c.agreement = a.id
            inner join configs con on con.id = c.config
            inner join agreements_types a_t on a_t.id = con.agreement_type
            where a_t.id = :agreement_type', ['agreement_type' => 2]);

        
        $contratos = count($contratos);
        return view('home', ['CONVENIOS' => $convenios, 'CONTRATOS' => $contratos]);
    }
}
