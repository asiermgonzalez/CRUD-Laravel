@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <a class="btn btn-success" href="{{ url('empleado/create') }}">Registrar nuevo empleado</a>

    <br><br>

    @if(Session::has('mensaje'))

    <div class="alert alert-success alert-dismissible col-6" role="alert">
        <strong>{{Session::get('mensaje') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @endif

    <table class="table table-light table-striped table-hover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Primer apellido</th>
                <th>Segundo apellido</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>

            @foreach($empleados as $empleado)

            <tr>
                <td scope="row">{{ $empleado->id }}</td>

                <td><img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" width="100"
                        alt=""></td>

                <td>{{ $empleado->Nombre }}</td>
                <td>{{ $empleado->Apellido1 }}</td>
                <td>{{ $empleado->Apellido2 }}</td>
                <td>{{ $empleado->Email }}</td>
                <td>{{ $empleado->Telefono }}</td>
                <td>
                    <a class="btn btn-warning" href="{{ url('/empleado/'.$empleado->id.'/edit') }}">Editar</a>

                    |

                    <form class="d-inline" action="{{ url('/empleado/'.$empleado->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}

                        <input class="btn btn-danger" type="submit"
                            onclick="return confirm('¿Seguro que quieres borrar el empleado?')" value="Borrar">

                    </form>

                </td>
            </tr>

            @endforeach

        </tbody>
    </table>

{!! $empleados->links() !!}

</div>

@endsection