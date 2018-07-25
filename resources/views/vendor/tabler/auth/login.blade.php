@extends('tabler::layouts.auth')
@section('content')
    {!! Form::open(['url' => url(config('tabler.url.post-login', 'login')), 'method' => 'POST', 'class' => 'card']) !!}
    <div class="card-body p-6">
        <div class="card-title">Sistema de Seguimiento de Contratos y Convenios Modificatorios</div>
        <div class="form-group">
            {!! Form::label('email', 'Usuario', ['class' => 'form-label']) !!}
            {!! Form::email('email', old('email'), ['placeholder' => 'Ingresa tu nombre de usuario', 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <label class="form-label" for="password">
                Contraseña
            </label>
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ingresa tu contraseña']) !!}
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">Acceder</button>
        </div>
    </div>
    {!! Form::close() !!}
@stop
