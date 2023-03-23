@extends('adminlte::page')

@section('title')
USUARIOS
@endsection

@section('content')
<div class="card  card-secondary mt-3">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">

            <span id="card_title">
                FORMULARIO DE REGISTRO
            </span>
            {{-- @can('roles.create') --}}
            <div class="float-right">
                <a href="javascript:void(0)" onclick="history.back()" class="btn btn-secondary btn-sm float-right"
                    data-placement="left">
                    <i class="fas fa-arrow-left"></i>
                    Volver
                </a>
            </div>
            {{-- @endcan --}}

        </div>
    </div>
    <div class="card-body">
        {!! Form::open(['route'=>'roles.store']) !!}
        @include('roles.form')
        
            {!! Form::submit('Registrar Rol', ['class'=>'btn btn-primary mt-3','style'=>'width: 250px']) !!}
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
@endsection