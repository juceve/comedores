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
                                <a href="{{ route('clientes.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                            {{ $cliente->empresa }}
                        </div>
                        <div class="form-group">
                            <strong>Cedula:</strong>
                            {{ $cliente->cedula }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $cliente->estado?'Activo':'Inactivo' }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
