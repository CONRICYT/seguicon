@extends('tabler::layouts.main')
@section('title', 'Inicio')
@section('content')
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Seguicon - Seguimineto de Contratos y Convenios Modificatorios</h3>
  </div>
  <div class="card-body">
      <div class="card p-3">
          <div class="d-flex align-items-center">
              <span class="stamp stamp-md bg-green mr-3">
                  <i class="fa fa-file-text-o"></i>
              </span>
              <div>
                  <h4 class="m-0"><a href="javascript:void(0)">{{ $CONTRATOS }} <small>Contratos</small></a></h4>
                  <!--small class="text-muted"> completado</small-->
              </div>
          </div>
      </div>
      <div class="card p-3">
          <div class="d-flex align-items-center">
              <span class="stamp stamp-md bg-green mr-3">
                  <i class="fa fa-file-text"></i>
              </span>
              <div>
                  <h4 class="m-0"><a href="javascript:void(0)">{{ $CONVENIOS }} <small>Convenios</small></a></h4>
                  <!--small class="text-muted">2 completado</small-->
              </div>
          </div>
      </div>
  </div>
</div>
@stop
