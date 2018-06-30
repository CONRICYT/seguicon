@extends('tabler::layouts.main')
@section('title', 'Inicio')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Seguicon - Seguimineto de Contratos y Convenios Modificatorios</h3>
  </div>
  <div class="card-body">
        <table class="table table-striped">
        <?php
            $current_agreement = '';
            $current_task = '';
            foreach ($INFO as $key => $value){

                if($current_agreement != $value->agreement && $current_agreement != '') {
                    echo '</td>
                        </tr>
                    </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center">
                <h1><a class="badge badge-success" data-toggle="collapse" href="#collapseExample'.$value->agreement.'" role="button" aria-expanded="false" aria-controls="collapseExample">'.$value->agreement_name.'</a></h1>
                    <div class="collapse" id="collapseExample'.$value->agreement.'">
                        <table class="table"><tr>';
                }else if($current_agreement != $value->agreement) {
                    echo '<tr>
                    <td class="text-center">
                    <h1><a class="badge badge-success" data-toggle="collapse" href="#collapseExample'.$value->agreement.'" role="button" aria-expanded="false" aria-controls="collapseExample">'.$value->agreement_name.'</a></h1>
                        <div class="collapse" id="collapseExample'.$value->agreement.'">
                            <table class="table">
                                <tr>';
                }

                if($current_task != $value->task_name && $current_task != '') {
                    echo '
                        </div>
                    </div>';
                }
                if($current_task != $value->task_name) {
                    $rand = rand(1,3);
                    $class = $rand == 1 ? 'bg-yellow' : '';
                    $class = $rand == 2 ? 'bg-red' : $class;
                    $class = $rand == 3 ? 'bg-green' : $class;

                ?>
                    <td>
                        <div class="progress progress-xs">
                            <div class="progress-bar {{ $class }}" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $value->task_name }}</h3>
                                <div class="card-options">
                                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                            <?php if($value->subtask_name != '') { ?>
                                <div class="card m-0">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h4 class="m-0 ml-2"><a href="javascript:void(0)"><small>{{ $value->subtask_name }}</small></a> </h4>
                                        </div>
                                        <label class="colorinput ml-auto m-1 mb-1">
                                          <input name="color" type="checkbox" value="azure" class="colorinput-input">
                                          <span class="colorinput-color"></span>
                                        </label>
                                    </div>
                                </div>
                            <?php }
                    } else{
                    ?>
                            <div class="card m-0">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h4 class="m-0 ml-2"><a href="javascript:void(0)"><small>{{ $value->subtask_name }}</small></a></h4>
                                    </div>
                                    <label class="colorinput ml-auto m-1 mb-1">
                                      <input name="color" type="checkbox" value="azure" class="colorinput-input">
                                      <span class="colorinput-color"></span>
                                    </label>
                                </div>
                            </div>
                        <?php
                    }

                $current_task =  $value->task_name;
                $current_agreement = $value->agreement;
            }
        ?>
                        </div>
                    </div>
                </td>
                </tr>
            </table>
        </div>
            </td>
            </tr>
        </table>
  </div>
</div>
@stop
