<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agreements_config;
use DB;
use App\Convenios;
use DateTime;
use Hash;
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
        /*$password = array(
            'mguajardom',
            'eramirez',
            'larreola',
            'sergiolr',
            'azurita',
            'mario.saavedra',
            'jibarram',
            'isaias.elizarraraz',
            'montiveros'
        );
        foreach ($password as $key => $value) {
            echo Hash::make($value).'<br><br>';
        }*/

        /*$convenios = DB::select('SELECT * FROM `agreements` a
            inner join agreements_config c on c.agreement = a.id
            inner join configs con on con.id = c.config
            inner join agreements_types a_t on a_t.id = con.agreement_type
            where a_t.id = :agreement_type', ['agreement_type' => 1]);*/
        $all_tasks = DB::select('SELECT t.name as task_name, t.id as task, s.id as subtask, s.name as subtask_name from subtasks s inner join tasks t on t.id = s.task
        order by t.id, s.id');

        $convenios = DB::select('SELECT c.id as config_id, a.id as "agreement", a.name as "agreement_name", a_t.name as "type_agreement", c.year, c.data, c.dates FROM `agreements` a
            inner join agreements_config c on c.agreement = a.id
            inner join configs con on con.id = c.config
            inner join agreements_types a_t on a_t.id = con.agreement_type
            where a_t.id = :agreement_type
            order by a.name', ['agreement_type' => 1]);


        $list_complete_conv = array();
        $stepsConvenios = array();
        $formalizadosConvenios = array();
        foreach($convenios as $key => $val){
            $data = json_decode($val->data);
            foreach ($data as $subtask) {
                if($subtask->subtask == 33 && $subtask->complete_date != ''){
                   $formalizadosConvenios[] = $val->agreement_name;
                }

                if($subtask->complete_date == ''){
                    $entro = false;
                    foreach ($all_tasks as $k => $v) {

                        if(($val->agreement == 46 || $val->agreement == 55  || $val->agreement == 11 ||
                        $val->agreement == 12 || $val->agreement == 14 || $val->agreement == 16 || $val->agreement == 26)
                        && ($v->task == 4 || $v->task == 6 || $v->task == 7)){
                            continue;
                        }

                        if($v->task == 12 || $v->task == 13) {
                            continue;
                        }

                        if($subtask->subtask == $v->subtask) {
                            $stepsConvenios[$v->task][] = $val->agreement_name;
                            $entro = true;
                        }
                    }
                    if($entro){
                        break;
                    }
                }
            }
        }

        $convenios = count($convenios);

        $contratos = DB::select('SELECT c.id as config_id, a.id as "agreement", a.name as "agreement_name", a_t.name as "type_agreement", c.year, c.data, c.dates FROM `agreements` a
            inner join agreements_config c on c.agreement = a.id
            inner join configs con on con.id = c.config
            inner join agreements_types a_t on a_t.id = con.agreement_type
            where a_t.id = :agreement_type
            order by a.name', ['agreement_type' => 2]);

        $list_complete_cont = array();
        $stepsContratos = array();
        $formalizadosContratos = array();
        $canceladosContratos = array();
        foreach($contratos as $key => $val){
            $data = json_decode($val->data);
            foreach ($data as $subtask) {
                if($subtask->subtask == 33 && $subtask->complete_date != ''){
                   $formalizadosContratos[] = $val->agreement_name;
                }

                if($subtask->subtask == 39 && $subtask->complete_date != ''){
                   $canceladosContratos[] = $val->agreement_name;
                   continue;
                }

                if($subtask->complete_date == ''){
                    $entro = false;
                    foreach ($all_tasks as $k => $v) {

                        if(($val->agreement == 46 || $val->agreement == 55  || $val->agreement == 11 ||
                        $val->agreement == 12 || $val->agreement == 14 || $val->agreement == 16 || $val->agreement == 26)
                        && ($v->task == 4 || $v->task == 6 || $v->task == 7)){
                            continue;
                        }

                        if($v->task == 12 || $v->task == 13) {
                            continue;
                        }

                        if($subtask->subtask == $v->subtask) {
                            $stepsContratos[$v->task][] = $val->agreement_name;
                            $entro = true;
                        }
                    }
                    if($entro) {
                        break;
                    }
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

        ksort($stepsContratos);
        ksort($stepsConvenios);
        $contratos = count($contratos);
        return view('home', ['CONVENIOS' => $convenios, 'CONTRATOS' => $contratos, 'CONTRATOS_C' => $canceladosContratos,
        'stepsConvenios' => $stepsConvenios, 'stepsContratos' => $stepsContratos, 'ALL_TASKS' => $all_tasks, 'CONVENIOS_F' => $formalizadosConvenios,  'CONTRATOS_F' => $formalizadosContratos]);
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
