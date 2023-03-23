@extends('adminlte::page')

@section('title')
USUARIOS
@endsection

@section('content')
<div class="card card-secondary mt-3">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">

            <span id="card_title">
                FORMULARIO DE EDICIÓN
            </span>
            {{-- @can('roles.create') --}}
            <div class="float-right">
                <a href="{{route('roles.index')}}" class="btn btn-secondary btn-sm float-right"
                    data-placement="left">
                    <i class="fas fa-arrow-left"></i>
                    Volver
                </a>
            </div>
            {{-- @endcan --}}

        </div>
    </div>
    <div class="card-body">
        {!! Form::model($role, ['route'=>['roles.update',$role], 'method' => 'put']) !!}
            @include('roles.form')            
            {!! Form::submit('Guardar cambios', ['class'=>'btn btn-primary mt-3','style'=>'width: 250px']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection
@section('js')
    <script>
        function selectAll(){
            $('.mr-1').prop('checked', true);
        }

        function unSelectAll(){
            $('.mr-1').prop('checked', false);
        }
    </script>

@if (session('success'))
    <script>
        Swal.fire("Excelente!", '{{session('success')}}','success');
    </script>
@endif
@endsection