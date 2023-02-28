@extends('adminlte::page')

@section('title')
    Info Franja
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary mt-3">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                 INFORMACIÓN DE FRANJA
                            </span>

                             <div class="float-right">
                                <a href="{{ route('franjas.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  <i class="fas fa-arrow-left"></i> Volver
                                </a>
                              </div>
                        </div>
                    </div>

                    <div class="card-body">                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $franja->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Hora inicio:</strong>
                            {{ $franja->horainicio }}
                        </div>
                        <div class="form-group">
                            <strong>Hora final:</strong>
                            {{ $franja->horafinal }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $franja->precio }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
