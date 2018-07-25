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
              <h3>Resumen</h3>
              <div class="card p-3">
                  <div class="d-flex align-items-center">
                      <div class="card card-collapsed">
                        <div class="card-header">
                            <span class="stamp stamp-md bg-secondary mr-3">
                                <i class="fa fa-file-text"></i>
                            </span>
                            <h4 class="m-0"><a href="/{{ $path }}/convenios">{{ $CONTRATOS }} <small>Contratos</small></a></h4>
                            <div class="card-options">
                                <small><a href="#" class="card-options-collapse" data-toggle="card-collapse">{{ $CONTRATOS_COMPLETE }} completado</a></small>
                            </div>
                        </div>
                        <div class="card-body">
                              <ul>
                                <?php
                                  foreach ($LIST_COMPLETE_CONT as $key => $value) {
                                      ?>
                                      <li>{{ $value }}</li>
                                      <?php
                                  }
                                ?>
                              </ul>
                        </div>
                      </div>
                  </div>
                  <div class="d-flex align-items-center">
                      <div class="card card-collapsed">
                        <div class="card-header">
                            <span class="stamp stamp-md bg-secondary mr-3">
                                <i class="fa fa-file-text"></i>
                            </span>
                            <h4 class="m-0"><a href="/{{ $path }}/convenios">{{ $CONVENIOS }} <small>Convenios</small></a></h4>
                            <div class="card-options">
                                <small><a href="#" class="card-options-collapse" data-toggle="card-collapse">{{ $CONVENIOS_COMPLETE }} completado</a></small>
                            </div>
                        </div>
                        <div class="card-body">
                              <ul>
                                <?php
                                  foreach ($LIST_COMPLETE_CONV as $key => $value) {
                                      ?>
                                      <li>{{ $value }}</li>
                                      <?php
                                  }
                                ?>
                              </ul>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-3 pull right">
              <h3>Código de colores</h3>
              <div class="card p-3">
                  <div class="d-flex align-items-center mb-3">
                      <span class="stamp stamp-md bg-blue mr-3">
                          <i class="fe fe-rotate-cw"></i>
                      </span>
                      <div>
                          <h4 class="m-0"><a href="#"><small>En proceso</small></a></h4>
                      </div>
                  </div>
                  <div class="d-flex align-items-center mb-3">
                      <span class="stamp stamp-md bg-yellow mr-3">
                          <i class="fe fe-info"></i>
                      </span>
                      <div>
                          <h4 class="m-0"><a href="#"><small>En límite de tiempo</small></a></h4>
                      </div>
                  </div>
                  <div class="d-flex align-items-center mb-3">
                      <span class="stamp stamp-md bg-green mr-3">
                          <i class="fe fe-check-square"></i>
                      </span>
                      <div>
                          <h4 class="m-0"><a href="#"><small>Completada</small></a></h4>
                      </div>
                  </div>
                  <div class="d-flex align-items-center mb-3">
                      <span class="stamp stamp-md bg-red mr-3">
                          <i class="fe fe-x-square"></i>
                      </span>
                      <div>
                          <h4 class="m-0"><a href="#"><small>Atrasada</small></a></h4>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@stop
