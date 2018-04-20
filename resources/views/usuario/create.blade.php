@extends('usuario.master')
@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="float-left">
        <h3>Registrar Persona</h3>
        <br/>
        <br/>
      </div>
    </div>
  </div>



  @if($message = Session::get('success'))
    <div class="alert alert-success">
      <p> {{ $message }} </p>
    </div>
  @endif

  <!--POST = REGISTRAR-->
  {{ Form::open(['method'=>'POST', 'route'=>'method_registrar']) }}
  @include('usuario.form')
  {{ Form::close() }}

@endsection
