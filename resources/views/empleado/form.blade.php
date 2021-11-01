<h1 class="text-center">{{ $modo }} empleado</h1>


@if(count($errors)>0)

<div class="alert alert-danger" role="alert">
    <ul>
        @foreach($errors->all() as $error)

            <li>{{$error}}</li>

        @endforeach
    </ul>
</div>

@endif


<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="Nombre">Nombre</label>
            <input type="text" class="form-control" name="Nombre" id="Nombre"
                value="{{ isset($empleado->Nombre) ? $empleado->Nombre : old('Nombre') }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="Apellido1">Primer Apellido</label>
            <input type="text" class="form-control" name="Apellido1" id="Apellido1"
                value="{{ isset($empleado->Apellido1) ? $empleado->Apellido1 : old('Apellido1')  }}">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="Apellido2">Segundo Apellido</label>
            <input type="text" class="form-control" name="Apellido2" id="Apellido2"
                value="{{ isset($empleado->Apellido2) ? $empleado->Apellido2 : old('Apellido2')  }}">
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="Email">Email</label>
            <input type="text" class="form-control" name="Email" id="Email"
                value="{{ isset($empleado->Email) ? $empleado->Email : old('Email')  }}">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="Telefono">Teléfono</label>
            <input type="text" class="form-control" name="Telefono" id="Telefono"
                value="{{ isset($empleado->Telefono) ? $empleado->Telefono : old('Telefono')  }}">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="Foto">Foto</label>

            @if(isset($empleado->Foto))
            <!--
            {{ $empleado->Foto }}
            -->
            <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" width="100" alt="">
            @endif

            <input type="file" class="form-control" name="Foto" id="Foto" value="">
        </div>
    </div>
</div>


<input type="submit" class="btn btn-success" value="{{ $modo }} datos">


<a class="btn btn-info" href="{{ url('empleado/') }}">Regresar</a>