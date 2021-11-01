@extends('layouts.app')

@section('content')

<div class="container p-4 shadow rounded">
    <div class="row">
        <div class="col-md-12">

            <form action="{{ url('/empleado') }}" method="post" enctype="multipart/form-data">

                @csrf

                @include('empleado.form', ['modo'=>'Crear'])

            </form>

        </div>
    </div>
</div>

@endsection