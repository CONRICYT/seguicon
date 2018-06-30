<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AgreementsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function convenios(){

        $results = DB::select('SELECT a.id as "agreement", a.name as "agreement_name", a_t.name as "type_agreement", c.year, c.data, c_t.task, t.name as "task_name", s.id as subtask, s.name as "subtask_name" FROM `agreements` a
            inner join agreements_config c on c.agreement = a.id
            inner join configs con on con.id = c.config
            inner join agreements_types a_t on a_t.id = con.agreement_type
            inner join configs_tasks c_t on c_t.config = c.config
            inner join tasks t on t.id = c_t.task
            left join subtasks s on s.task = t.id
            where a_t.id = :agreement_type
            order by a.name, t.id ', ['agreement_type' => 1]);

        $data = ['title' => 'Convenios' , 'INFO' => $results];

        return view('convenios', $data);
    }

    public function contratos(){
        $results = DB::select('SELECT a.id as "agreement", a.name as "agreement_name", a_t.name as "type_agreement", c.year, c.data, c_t.task, t.name as "task_name", s.id as subtask, s.name as "subtask_name" FROM `agreements` a
            inner join agreements_config c on c.agreement = a.id
            inner join configs con on con.id = c.config
            inner join agreements_types a_t on a_t.id = con.agreement_type
            inner join configs_tasks c_t on c_t.config = c.config
            inner join tasks t on t.id = c_t.task
            left join subtasks s on s.task = t.id
            where a_t.id = :agreement_type
            order by a.name, t.id', ['agreement_type' => 2]);

        $data = ['INFO' => $results];

        return view('convenios', $data);
    }
}
