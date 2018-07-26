@extends('tabler::layouts.main')
@section('title', 'Inicio')
@section('content')
<?php
$path = '';
if ($USER->role == config('app.CONST.SUPER_ROLE')){
    $path = 'admin';
} else if($USER->role == config('app.CONST.ADMIN_ROLE')) {
    $path = 'admin';
} else if($USER->role == config('app.CONST.ADQUISICIONES_ROLE')) {
    $path = 'agreements';
} else if($USER->role == config('app.CONST.REVISION_ROLE')) {
    $path = 'views';
}
?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Seguimiento de Contratos y Convenios Modificatorios</h3>
  </div>
  <div class="card-body">
      <div class="row">
          <div class="col-lg-6">
              <div class="accordion" id="accordionCont">
                  <div class="card mb-0">
                    <div class="card-header" id="headingX">
                      <h3 class="mb-0">
                          <h2 class="m-0"><a href="/{{ $path }}/contratos">{{ $CONTRATOS }} Contratos</a></h2>
                      </h3>
                    </div>
                  </div>
                  <div class="card mb-0"  style="background-color: rgba(0, 0, 0, 0.04);">
                    <div class="card-header" id="headingX">
                      <h3 class="mb-0">
                          <h2 class="m-0">Etapas del proceso</h2>
                      </h3>
                      <h3 class="card-options">No. de<br>instrumentos</h3>
                    </div>
                  </div>
                  <?php foreach ($stepsContratos as $key => $value): ?>

                      <div class="card mb-0">
                        <div class="card-header" id="heading{{ $key }}">
                          <h5 class="mb-0">
                            <a href="#" data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
                              <?php foreach ($ALL_TASKS as $k => $v):
                                        if($v->task == $key){
                                            echo $v->task_name;
                                            break;
                                        }
                                    endforeach; ?>
                            </a>
                          </h5>
                          <div class="card-options chart-circle chart-circle-xs" data-value="1" data-thickness="3" data-color="blue"><canvas width="40" height="40"></canvas>
                              <div class="chart-circle-value text-dark"><?= count($value) ?></div>
                          </div>
                        </div>

                        <div id="collapse{{ $key }}" class="collapse <?= $key ==0 ? 'active' : '' ?>" aria-labelledby="heading{{ $key }}" data-parent="#accordionCont">
                          <div class="card-body">
                              <ul>
                                  <?php foreach ($value as $k => $v) {
                                      ?>
                                      <li>{{ $v }}</li>
                                      <?php
                                  }
                                  ?>
                              </ul>
                          </div>
                        </div>
                      </div>
                  <?php endforeach; ?>
              </div>
          </div>
          <div class="col-lg-6">
              <div class="accordion" id="accordionConv">
                  <div class="card mb-0">
                    <div class="card-header" id="headingX">
                      <h3 class="mb-0">
                          <h2 class="m-0"><a href="/{{ $path }}/convenios">{{ $CONVENIOS }} Convenios</a></h2>
                      </h3>
                    </div>
                  </div>
                  <div class="card mb-0" style="background-color: rgba(0, 0, 0, 0.04);">
                    <div class="card-header" id="headingX">
                      <h3 class="mb-0">
                          <h2 class="m-0">Etapas del proceso</h2>
                      </h3>
                      <h3 class="card-options">No. de<br>instrumentos</h3>
                    </div>
                  </div>
                  <?php foreach ($stepsConvenios as $key => $value): ?>

                      <div class="card mb-0">
                        <div class="card-header" id="heading{{ $key }}">
                          <h5 class="mb-0">
                            <a href="#" data-toggle="collapse" data-target="#collapse_{{ $key }}" aria-expanded="true" aria-controls="collapse_{{ $key }}">
                              <?php foreach ($ALL_TASKS as $k => $v):
                                        if($v->task == $key){
                                            echo $v->task_name;
                                            break;
                                        }
                                    endforeach; ?>
                            </a>
                          </h5>
                          <div class="card-options chart-circle chart-circle-xs" data-value="1" data-thickness="3" data-color="blue"><canvas width="40" height="40"></canvas>
                              <div class="chart-circle-value text-dark"><?= count($value) ?></div>
                          </div>
                        </div>

                        <div id="collapse_{{ $key }}" class="collapse <?= $key ==0 ? 'active' : '' ?>" aria-labelledby="heading{{ $key }}" data-parent="#accordionConv">
                          <div class="card-body">
                              <ul>
                                  <?php foreach ($value as $k => $v) {
                                      ?>
                                      <li>{{ $v }}</li>
                                      <?php
                                  }
                                  ?>
                              </ul>
                          </div>
                        </div>
                      </div>
                  <?php endforeach; ?>
              </div>
          </div>
      </div>
  </div>
</div>
@stop
