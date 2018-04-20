@extends('usuario.master')
@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="float-left">
        <h3>Modificar Datos</h3>
        <br/>
        <br/>
      </div>
    </div>
  </div>



  <!--PUT = ACTUALIZAR-->
  {{ Form::model($user, ['method'=>'PUT', 'route'=>['method_modificar_id', $user->id]]) }}
  @include('usuario.form')
  {{ Form::close() }}

@endsection
