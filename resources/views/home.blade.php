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
$subtotal = 0;
$subtotal2 = 0;
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
                                      $subtotal++;
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
                  <div class="card mb-0"  style="background-color: rgba(0, 0, 0, 0.04);">
                    <div class="card-header" id="headingX">
                      <h3 class="mb-0">
                          <h2 class="m-0">Subtotal</h2>
                      </h3>
                      <h3 class="card-options"  style="padding-left: 55px; margin-bottom: 0px;"><?= $subtotal ?></h3>
                    </div>
                  </div>
                  <div class="card mb-0">
                    <div class="card-header" id="headingZ">
                      <h5 class="mb-0">
                        <a href="#" data-toggle="collapse" data-target="#collapse_Z" aria-expanded="true" aria-controls="collapse_Z">
                         Formalizados
                        </a>
                      </h5>
                      <div class="card-options chart-circle chart-circle-xs" data-value="1" data-thickness="3" data-color="blue"><canvas width="40" height="40"></canvas>
                          <div class="chart-circle-value text-dark"><?= count($CONTRATOS_F) ?></div>
                      </div>
                    </div>
                    <div id="collapse_Z" class="collapse <?= $key ==0 ? 'active' : '' ?>" aria-labelledby="headingZ" data-parent="#accordionConv">
                      <div class="card-body">
                          <ul>
                              <?php foreach ($CONTRATOS_F as $k => $v) {
                                  ?>
                                  <li>{{ $v }}</li>
                                  <?php
                              }
                              ?>
                          </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card mb-0">
                    <div class="card-header" id="headingZZ">
                      <h5 class="mb-0">
                        <a href="#" data-toggle="collapse" data-target="#collapse_ZZ" aria-expanded="true" aria-controls="collapse_ZZ">
                         Cancelados
                        </a>
                      </h5>
                      <div class="card-options chart-circle chart-circle-xs" data-value="1" data-thickness="3" data-color="blue"><canvas width="40" height="40"></canvas>
                          <div class="chart-circle-value text-dark"><?= count($CONTRATOS_C) ?></div>
                      </div>
                    </div>
                    <div id="collapse_ZZ" class="collapse <?= $key ==0 ? 'active' : '' ?>" aria-labelledby="headingZZ" data-parent="#accordionConv">
                      <div class="card-body">
                          <ul>
                              <?php foreach ($CONTRATOS_C as $k => $v) {
                                  ?>
                                  <li>{{ $v }}</li>
                                  <?php
                              }
                              ?>
                          </ul>
                      </div>
                    </div>
                  </div>
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
                                      $subtotal2++;
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
                  <div class="card mb-0" style="background-color: rgba(0, 0, 0, 0.04);">
                    <div class="card-header" id="headingX">
                      <h3 class="mb-0">
                          <h2 class="m-0">Subtotal</h2>
                      </h3>
                      <h3 class="card-options" style="padding-left: 55px; margin-bottom: 0px;"><?= $subtotal2 ?></h3>
                    </div>
                  </div>
                  <div class="card mb-0">
                    <div class="card-header" id="headingQ">
                      <h5 class="mb-0">
                        <a href="#" data-toggle="collapse" data-target="#collapse_Q" aria-expanded="true" aria-controls="collapse_Q">
                         Formalizados
                        </a>
                      </h5>
                      <div class="card-options chart-circle chart-circle-xs" data-value="1" data-thickness="3" data-color="blue"><canvas width="40" height="40"></canvas>
                          <div class="chart-circle-value text-dark"><?= count($CONVENIOS_F) ?></div>
                      </div>
                    </div>

                    <div id="collapse_Q" class="collapse <?= $key ==0 ? 'active' : '' ?>" aria-labelledby="headingQ" data-parent="#accordionConv">
                      <div class="card-body">
                          <ul>
                              <?php foreach ($CONVENIOS_F as $k => $v) {
                                  ?>
                                  <li>{{ $v }}</li>
                                  <?php
                              }
                              ?>
                          </ul>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@stop
