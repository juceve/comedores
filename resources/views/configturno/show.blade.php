@extends('layouts.app')

@section('template_title')
    {{ $configturno->name ?? 'Show Configturno' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Configturno</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('configturnos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Turno Id:</strong>
                            {{ $configturno->turno_id }}
                        </div>
                        <div class="form-group">
                            <strong>Franja Id:</strong>
                            {{ $configturno->franja_id }}
                        </div>
                        <div class="form-group">
                            <strong>Generareserva:</strong>
                            {{ $configturno->generareserva }}
                        </div>
                        <div class="form-group">
                            <strong>Reservafranja:</strong>
                            {{ $configturno->reservafranja }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
