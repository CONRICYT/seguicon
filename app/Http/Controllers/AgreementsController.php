<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use \Datetime;

use App\Agreements_config;

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

    public function convenios($only_view = false, $is_admin=false){

        $results = DB::select('SELECT a.id as "agreement", a.name as "agreement_name", a_t.name as "type_agreement", c.year, c.data, c_t.task, t.name as "task_name", s.id as subtask, s.name as "subtask_name", c.dates FROM `agreements` a
            inner join agreements_config c on c.agreement = a.id
            inner join configs con on con.id = c.config
            inner join agreements_types a_t on a_t.id = con.agreement_type
            inner join configs_tasks c_t on c_t.config = c.config
            inner join tasks t on t.id = c_t.task
            left join subtasks s on s.task = t.id
            where a_t.id = :agreement_type
            order by a.name, t.id, s.id', ['agreement_type' => 1]);

        $data = ['title' => 'Convenios', 'ID_TYPE' => 1, 'TIPO' => 'Convenios Modificatorios', 'INFO' => $results, 'ONLY_VIEW' => $only_view, 'IS_ADMIN' => $is_admin];

        return view('convenios', $data);
    }

    public function view_convenios(){
        return $this->convenios(true);
    }

    public function admin_convenios(){
        return $this->convenios(false, true);
    }

    public function contratos($only_view = false, $is_admin=false){
        $results = DB::select('SELECT a.id as "agreement", a.name as "agreement_name", a_t.name as "type_agreement", c.year, c.data, c_t.task, t.name as "task_name", s.id as subtask, s.name as "subtask_name", c.dates FROM `agreements` a
            inner join agreements_config c on c.agreement = a.id
            inner join configs con on con.id = c.config
            inner join agreements_types a_t on a_t.id = con.agreement_type
            inner join configs_tasks c_t on c_t.config = c.config
            inner join tasks t on t.id = c_t.task
            left join subtasks s on s.task = t.id
            where a_t.id = :agreement_type
            order by a.name, t.id, s.id', ['agreement_type' => 2]);

        $data = ['title' => 'Contratos',  'ID_TYPE' => 2, 'TIPO' => 'Contratos', 'INFO' => $results, 'ONLY_VIEW' => $only_view, 'IS_ADMIN' => $is_admin];

        return view('convenios', $data);
    }

    public function view_contratos(){
        return $this->contratos(true);
    }

    public function admin_contratos(){
        return $this->contratos(false, true);
    }

    public function check(Request $request){

        $agreementConfig =  new Agreements_config();
        $res = $agreementConfig->where('agreement', $request->agreement)->get();
        if(count($res)>0){
            $current_agreement_config = $res[0];
            $data = $current_agreement_config->data;
            if($data != ''){
                $data =  json_decode($data);
                $entro = false;
                foreach ($data as $key => $value) {
                    if($value->subtask == $request->subtask) {
                        $entro = true;
                        $data[$key]->complete_date = date('Y-m-d H:i:s');
                    }
                }
                if(!$entro) {
                    $data[] = (object) ['subtask' => $request->subtask, 'complete_date' => date('Y-m-d H:i:s')];
                }
            } else {
                $data = array();
                $data[] = (object) ['subtask' => $request->subtask, 'complete_date' => date('Y-m-d H:i:s')];
            }
            $data = json_encode($data);
            $current_agreement_config->data = $data;
            $current_agreement_config->save();
            return json_encode(array('result' => 1, 'complete_date' => date('d-m-Y')));

        } else {
            return json_encode(array('result' => 0, 'errors' => 'No se logro guardar la información'));
        }
    }

    public function updateDate(Request $request){
        $agreementConfig =  new Agreements_config();
        $res = $agreementConfig->where('agreement', $request->agreement)->get();

        $startDate = DateTime::createFromFormat('d-m-Y H:i:s', $request->startDate);
        $startDate =  $startDate->format('Y-m-d H:i:s');

        $endDate = DateTime::createFromFormat('d-m-Y H:i:s', $request->endDate);
        $endDate = $endDate->format('Y-m-d H:i:s');

        if(count($res)>0){
            $current_agreement_config = $res[0];
            $dates = $current_agreement_config->dates;

            if($dates != ''){
                $dates =  json_decode($dates);
                $entro = false;
                foreach ($dates as $key => $value) {
                    if($value->task == $request->task) {
                        $entro = true;
                        $dates[$key]->start_date = $startDate;
                        $dates[$key]->end_date = $endDate;
                    }
                }
                if(!$entro) {
                    $dates[] = (object) ['task' => $request->task, 'start_date' => $startDate, 'end_date' => $endDate];
                }
            } else {
                $dates = array();
                $dates[] = (object) ['task' => $request->task, 'start_date' => $startDate, 'end_date' => $endDate];
            }
            $dates = json_encode($dates);
            $current_agreement_config->dates = $dates;
            $current_agreement_config->save();
            return json_encode(array('result' => 1));
        } else {
            return json_encode(array('result' => 0, 'errors' => 'No se logro guardar la información'));
        }
    }
}
