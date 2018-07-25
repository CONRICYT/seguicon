<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agreements_config;
use DB;
use App\Convenios;
use DateTime;

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
        /*$convenios = DB::select('SELECT * FROM `agreements` a
            inner join agreements_config c on c.agreement = a.id
            inner join configs con on con.id = c.config
            inner join agreements_types a_t on a_t.id = con.agreement_type
            where a_t.id = :agreement_type', ['agreement_type' => 1]);*/

            $convenios = DB::select('SELECT c.id as config_id, a.id as "agreement", a.name as "agreement_name", a_t.name as "type_agreement", c.year, c.data, c.dates FROM `agreements` a
                inner join agreements_config c on c.agreement = a.id
                inner join configs con on con.id = c.config
                inner join agreements_types a_t on a_t.id = con.agreement_type
                where a_t.id = :agreement_type
                order by a.name', ['agreement_type' => 1]);

        $convenios_complete = 0;
        $list_complete_conv = array();
        foreach($convenios as $key => $val){
            $data = json_decode($val->data);
            $dates = json_decode($val->dates);
            foreach ($data as $subtask) {
                if($subtask->subtask == 35 && $subtask->complete_date != ''){
                    $convenios_complete++;
                    $list_complete_conv[] = $val->agreement_name;
                }
            }
            /////////////////////////////////////
            /*
            $last_end_date = '';

            foreach ($dates as $task) {
                $numDays = 1;
                if($task->task == 1) {
                    $numDays = 1;
                } else if($task->task == 2) {
                    $numDays = 60; //Son 40 realmente
                } else if($task->task == 3) {
                    $numDays = 10;
                } else if($task->task == 4) {
                    $numDays = 4;
                } else if($task->task == 5) {
                    $numDays = 4;
                } else if($task->task == 6) {
                    $numDays = 3;
                } else if($task->task == 7) {
                    $numDays = 1;
                } else if($task->task == 8) {
                    $numDays = 10;
                } else if($task->task == 9) {
                    $numDays = 0;
                } else if($task->task == 10) {
                    $numDays = 2;
                } else if($task->task == 11) {
                    $numDays = 7;
                } else if($task->task == 12) {
                    $numDays = 1;
                } else if($task->task == 13) {
                    $numDays = 1;
                }

                if($task->start_date == '') {
                    if($last_end_date == '') {
                        $last_end_date = date('Y-m-d').' 00:00:00';
                    } else if($last_end_date<(date('Y-m-d').' 00:00:00')){
                        $last_end_date = date('Y-m-d').' 00:00:00';
                    } else {
                        $last_end_date = substr($last_end_date, 0, -8).'00:00:00';
                    }
                    $task->start_date = $this->addDays($last_end_date, 1, true);
                    //$last_end_date = $this->addDays($last_end_date, 1, true);
                }
                if($task->end_date == ''){
                    $task->end_date = $this->addDays($task->start_date, $numDays);
                    $last_end_date = $this->addDays($task->start_date, $numDays);
                }
            }

            $currentCon = Convenios::find($val->config_id);
            $currentCon->dates = json_encode(array_values($dates));
            $currentCon->save();
            */
        }
        $convenios = count($convenios);


        $contratos = DB::select('SELECT c.id as config_id, a.id as "agreement", a.name as "agreement_name", a_t.name as "type_agreement", c.year, c.data, c.dates FROM `agreements` a
            inner join agreements_config c on c.agreement = a.id
            inner join configs con on con.id = c.config
            inner join agreements_types a_t on a_t.id = con.agreement_type
            where a_t.id = :agreement_type
            order by a.name', ['agreement_type' => 2]);

        $contratos_complete = 0;
        $list_complete_cont = array();

        foreach($contratos as $key => $val){
            $data = json_decode($val->data);
            $dates = json_decode($val->dates);

            foreach ($data as $subtask) {
                if($subtask->subtask == 35 && $subtask->complete_date != ''){
                    $contratos_complete++;
                    $list_complete_cont[] = $val->agreement_name;
                }
            }

            /////////////////////
            /*
            $last_end_date = '';

            foreach ($dates as $task) {
                $numDays = 1;
                if($task->task == 1) {
                    $numDays = 1;
                } else if($task->task == 2) {
                    $numDays = 1; //Son 40 realmente
                } else if($task->task == 3) {
                    $numDays = 10;
                } else if($task->task == 4) {
                    $numDays = 6;
                } else if($task->task == 5) {
                    $numDays = 6;
                } else if($task->task == 6) {
                    $numDays = 4;
                } else if($task->task == 7) {
                    $numDays = 1;
                } else if($task->task == 8) {
                    $numDays = 10;
                } else if($task->task == 9) {
                    $numDays = 1;
                } else if($task->task == 10) {
                    $numDays = 2;
                } else if($task->task == 11) {
                    $numDays = 7;
                } else if($task->task == 12) {
                    $numDays = 1;
                } else if($task->task == 13) {
                    $numDays = 1;
                }

                if($task->start_date == '') {
                    if($last_end_date == '') {
                        $last_end_date = date('Y-m-d').' 00:00:00';
                    } else if($last_end_date<(date('Y-m-d').' 00:00:00')){
                        $last_end_date = date('Y-m-d').' 00:00:00';
                    } else {
                        $last_end_date = substr($last_end_date, 0, -8).'00:00:00';
                    }
                    $task->start_date = $this->addDays($last_end_date, 1, true);
                    //$last_end_date = $this->addDays($last_end_date, 1, true);
                }
                if($task->end_date == ''){
                    $task->end_date = $this->addDays($task->start_date, $numDays);
                    $last_end_date = $this->addDays($task->start_date, $numDays);
                }
            }

            $currentCon = Convenios::find($val->config_id);
            $currentCon->dates = json_encode(array_values($dates));
            $currentCon->save();
            /////////////////////
            */
        }

        $contratos = count($contratos);
        return view('home', ['CONVENIOS' => $convenios, 'CONTRATOS' => $contratos,
        'CONTRATOS_COMPLETE' => $contratos_complete, 'CONVENIOS_COMPLETE' => $convenios_complete,
        'LIST_COMPLETE_CONV' => $list_complete_conv, 'LIST_COMPLETE_CONT' => $list_complete_cont
    ]);
    }

    function addDays($date, $numdays, $full = false){
        $d = new DateTime($date);
        $t = $d->getTimestamp();

        // loop for X days
        for($i=0; $i<$numdays; $i++){

            // add 1 day to timestamp
            $addDay = 86390;
            if($full) {
                $addDay = 86400;
            }

            // get what day it is next day
            $nextDay = date('w', ($t+$addDay));

            // if it's Saturday or Sunday get $i-1
            if($nextDay == 0 || $nextDay == 6) {
                $i--;
            }
            $t = $t+$addDay;
        }

        $d->setTimestamp($t);

        return $d->format( 'Y-m-d H:i:s' );
    }
}
