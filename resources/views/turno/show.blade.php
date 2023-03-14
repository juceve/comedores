@extends('adminlte::page')

@section('title')
INFO TURNO
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary mt-3">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            Información de Turno
                        </span>

                        <div class="float-right">
                            <a href="{{ route('turnos.index') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                <i class="fas fa-arrow-left"></i> {{ __('Volver') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $turno->nombre }}
                    </div>
                    <div class="form-group">
                        <strong>Estado:</strong>
                        @if ($turno->estado)
                        <span style="width: 60px;" class="badge rounded-pill bg-success">Activo</span>
                        @else
                        <span style="width: 60px;" class="badge rounded-pill bg-secondary">Inactivo</span>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection