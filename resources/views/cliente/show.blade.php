@extends('adminlte::page')

@section('title')
INFO CLIENTE
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary mt-3">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            INFORMACIÓN DEL CLIENTE
                        </span>

                        <div class="float-right">
                            <a href="{{ route('clientes.index') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                <i class="fas fa-arrow-left"></i> {{ __('Volver') }}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $cliente->nombre }}
                    </div>
                    <div class="form-group">
                        <strong>Cargo:</strong>
                        {{ $cliente->cargo }}
                    </div>
                    <div class="form-group">
                        <strong>Empresa:</strong>
                        {{ $cliente->empresa->nombre }}
                    </div>
                    <div class="form-group">
                        <strong>Cedula:</strong>
                        {{ $cliente->cedula }}
                    </div>
                    <div class="form-group">
                        <strong>Estado:</strong>
                        @if ($cliente->estado)
                        <span style="width: 60px;" class="badge rounded-pill bg-success">Activo</span>
                        @else
                        <span style="width: 60px;" class="badge rounded-pill bg-secondary">Inactivo</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <strong>Lunch:</strong>
                        @if ($cliente->lunch)
                        <span style="width: 60px;" class="badge rounded-pill bg-success">Activo</span>
                        @else
                        <span style="width: 60px;" class="badge rounded-pill bg-secondary">Inactivo</span>
                        @endif
                    </div>
                    <hr>
                    @if ($logs->count() > 0)
                       <div class="content">
                        <h5><strong>Registro de Activaciones Lunches</strong></h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm table-striped">
                                <thead>
                                   <tr class="table-primary">
                                    <th style="width: 33%">FECHA</th>
                                    <th style="width: 33%">TIPO</th>
                                    <th style="width: 34%">AUTORIZADO POR</th>
                                </tr> 
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                      <tr>
                                        <td>{{$log->created_at}}</td>
                                        <td>{{$log->tipo}}</td>
                                        <td>{{$log->user->name}}</td>
                                    </tr>  
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div> 
                    @endif
                    

                </div>
            </div>
        </div>
    </div>
</section>
@endsection