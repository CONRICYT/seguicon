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
    <h3 class="card-title">Seguicon - Seguimineto de Contratos y Convenios Modificatorios</h3>
  </div>
  <div class="card-body">
      <div class="card p-3">
          <div class="d-flex align-items-center">
              <span class="stamp stamp-md bg-primary mr-3">
                  <i class="fa fa-file-text-o"></i>
              </span>
              <div>
                  <h4 class="m-0"><a href="/{{ $path }}/contratos">{{ $CONTRATOS }} <small>Contratos</small></a></h4>
                  <small class="text-muted">{{ $CONTRATOS_COMPLETE }} completado</small>
              </div>
          </div>
      </div>
      <div class="card p-3">
          <div class="d-flex align-items-center">
              <span class="stamp stamp-md bg-primary mr-3">
                  <i class="fa fa-file-text"></i>
              </span>
              <div>
                  <h4 class="m-0"><a href="/{{ $path }}/convenios">{{ $CONVENIOS }} <small>Convenios</small></a></h4>
                  <small class="text-muted">{{ $CONVENIOS_COMPLETE }} completado</small>
              </div>
          </div>
      </div>
  </div>
</div>
@stop
