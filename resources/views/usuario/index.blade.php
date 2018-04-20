@extends('usuario.master')

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <h3>Tabla Persona CRUD</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="float-right">
        <a class="btn btn-xs btn-success" href="{{ route('vista_registrar')  }}"> Registrar Persona </a>
      </div>
    </div>
  </div>

  <br/>



  <table class="table table-bordered">
    <tr>
      <th>N.</th>
      <th>Nombre</th>
      <th>Fecha Nacimiento</th>
      <th>Edad</th>
      <th width="350px">Acciones</th>
    </tr>

    @foreach($user as $us)
					<tr>
            <td style="display:none">{{ $i++ }}</td> <!--Oculta el valor de "i" cada vez que se registra un dato-->
            <td>{{ $us['id']}}</td>
						<td>{{ $us['nombre'] }}</td>
						<td>{{ $us['fecha'] }}</td>
						<td>{{ $us['edad'] }}</td>

            <td>
              <a class="btn btn-xs btn-info" href="{{ route('vista_consultar', $us->id) }}">Consultar</a>
              <a class="btn btn-xs btn-primary" href="{{ route('vista_editar', $us->id) }}">Modificar</a>

              {{ Form::open(['method'=>'DELETE', 'route'=>['method_eliminar_id', $us->id], 'style'=>'display:inline']) }}
              {{ Form::submit('Eliminar', ['class'=>'btn btn-xs btn-danger']) }}
              {{ Form::close() }}
            </td>

					</tr>
				@endforeach
  </table>

  <!--Se muestra la Paginación, debido a que se
  encuentra definida en UsuarioController-->
  {{ $user->links() }}
@endsection
