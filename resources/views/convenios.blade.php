@extends('tabler::layouts.main')
@section('title', 'Inicio')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Seguicon - Seguimineto de {{ $TIPO }}</h3>
  </div>
  <div class="card-body">
        @csrf
        <table class="table table-striped">
        <?php
            $current_agreement = '';
            $current_task = '';
            $idx = 0;
            foreach ($INFO as $key => $value){
                $dates = $value->dates;
                $dates = json_decode($dates);

                //Extraer fechas de la configuracion
                $start_date = '';
                $end_date = '';
                foreach ($dates as $config_date) {
                    if($config_date->task == $value->task){
                        $start_date = date('d-m-Y H:i', strtotime($config_date->start_date));
                        $end_date = date('d-m-Y H:i', strtotime($config_date->end_date));
                    }
                }

                $data = $value->data;
                $data = json_decode($data);

                $tooltip = false;
                $text_tooltip = '';
                if(is_array($data)) {
                    foreach ($data as $config_data) {
                        if($config_data->subtask == $value->subtask){
                            if($config_data->complete_date != ''){
                                $tooltip = true;
                                $text_tooltip = 'Completada el '.date('d-m-Y', strtotime($config_data->complete_date));
                            }
                        }
                    }
                }

                if($current_agreement != $value->agreement && $current_agreement != '') {
                    $idx = 0;
                    echo '</td>
                        </tr>
                    </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                <h1><a class="" data-toggle="collapse" href="#collapseExample'.$value->agreement.'" role="button" aria-expanded="false" aria-controls="collapseExample">'.$value->agreement_name.'</a></h1>
                    <div class="collapse" id="collapseExample'.$value->agreement.'">
                        <table class="table"><tr class="row">';
                }else if($current_agreement != $value->agreement) {
                    echo '<tr>
                    <td>
                    <h1><a class="" data-toggle="collapse" href="#collapseExample'.$value->agreement.'" role="button" aria-expanded="false" aria-controls="collapseExample">'.$value->agreement_name.'</a></h1>
                        <div class="collapse" id="collapseExample'.$value->agreement.'">
                            <table class="table"><tr class="row">';
                }

                if($current_task != $value->task_name && $current_task != '') {
                    echo '
                        </div>
                    </div>';
                }
                if($current_task != $value->task_name) {
                    $idx++;
                ?>
                    <td class="col-md-4">
                        <div class="progress progress-xs">
                            <div class="progress-bar colorBar{{ $value->agreement }}_{{ $value->task }}" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="card card_task <?= isset($ONLY_VIEW) && $ONLY_VIEW ? 'card-collapsed' : '' ?>" data-task="{{ $value->task }}" data-agreement="{{ $value->agreement }}">
                            <div class="card-header">
                                <h3 class="card-title"> {{ $idx }}.- <?= $value->task_name ?></h3>
                                <div class="card-options">
                                    <div class=""><small>
                                        <div class="form-group">
                                            <div class="input-group date <?= isset($IS_ADMIN) && $IS_ADMIN ? 'datetimepicker' : '' ?>" data-url="{{ action('AgreementsController@updateDate') }}" data-function-data="updateTaskData" data-function-success="updateTask" data-function-error="updateTaskError">
                                                <label class="updateDate startDate">{{ $start_date }}&nbsp;</label>
                                                <input type="hidden" class="form-control" value="{{ $start_date }}"/>
                                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                            </div>
                                            <div class="input-group date <?= isset($IS_ADMIN) && $IS_ADMIN ? 'datetimepicker' : '' ?>" data-url="{{ action('AgreementsController@updateDate') }}" data-function-data="updateTaskData" data-function-success="updateTask" data-function-error="updateTaskError">
                                                <label class="updateDate endDate">{{ $end_date }}&nbsp;</label>
                                                <input type="hidden" class="form-control" value="{{ $end_date }}"/>
                                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                            </div>
                                        </div>
                                    </small></div>
                                    <?= isset($ONLY_VIEW) && $ONLY_VIEW ? '' : '<a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>' ?>
                                </div>
                            </div>
                            <div class="card-body">
                            <?php if($value->subtask_name != '') { ?>
                                <div class="card m-0">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h4 class="m-0 ml-2"><a href="javascript:void(0)"><small><?= $value->subtask_name ?></small></a> </h4>
                                        </div>
                                        <label class="colorinput ml-auto m-1 mb-1">
                                          <input name="color" type="checkbox" value="{{ $value->subtask }}" data-agreement="{{ $value->agreement }}" class="colorinput-input <?= isset($ONLY_VIEW) && $ONLY_VIEW ? 'onlyView' : 'checkTask' ?>" data-url="{{ action('AgreementsController@check') }}" data-function-data="checkTaskData" data-function-success="checkTask" data-function-error="checkTaskError" <?= $tooltip ? 'checked="checked"' : '' ?>>
                                            <?php
                                                if($tooltip) {
                                            ?>
                                            <span class="colorinput-color" data-toggle="tooltip" data-original-title="<?= $text_tooltip ?>"></span>
                                            <?php
                                                } else {
                                            ?>
                                            <span class="colorinput-color"></span>
                                            <?php
                                                }
                                              ?>
                                        </label>
                                    </div>
                                </div>
                            <?php }
                    } else{
                    ?>
                            <div class="card m-0">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h4 class="m-0 ml-2"><a href="javascript:void(0)"><small><?= $value->subtask_name ?></small></a></h4>
                                    </div>
                                    <label class="colorinput ml-auto m-1 mb-1">
                                      <input name="color" type="checkbox" value="{{ $value->subtask }}" data-agreement="{{ $value->agreement }}" class="colorinput-input  <?= isset($ONLY_VIEW) && $ONLY_VIEW ? 'onlyView' : 'checkTask' ?>" data-url="{{ action('AgreementsController@check') }}" data-function-data="checkTaskData" data-function-success="checkTask" data-function-error="checkTaskError" <?= $tooltip ? 'checked="checked"' : '' ?>>
                                      <?php
                                          if($tooltip) {
                                      ?>
                                      <span class="colorinput-color" data-toggle="tooltip" data-original-title="<?= $text_tooltip ?>"></span>
                                      <?php
                                          } else {
                                      ?>
                                      <span class="colorinput-color"></span>
                                      <?php
                                          }
                                        ?>
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
