@extends('layouts.app')

@section('template_title')
    {{ $clienteturno->name ?? 'Show Clienteturno' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Clienteturno</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('clienteturnos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Cliente Id:</strong>
                            {{ $clienteturno->cliente_id }}
                        </div>
                        <div class="form-group">
                            <strong>Turno Id:</strong>
                            {{ $clienteturno->turno_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
