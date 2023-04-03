@extends('layouts.app')

@section('template_title')
    {{ $reganulacione->name ?? 'Show Reganulacione' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Reganulacione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('reganulaciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $reganulacione->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Entrega Id:</strong>
                            {{ $reganulacione->entrega_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $reganulacione->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ip:</strong>
                            {{ $reganulacione->ip }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
