@extends('layouts.app')

@section('template_title')
    {{ $entrega->name ?? 'Show Entrega' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Entrega</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('entregas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $entrega->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Cliente Id:</strong>
                            {{ $entrega->cliente_id }}
                        </div>
                        <div class="form-group">
                            <strong>Franja Id:</strong>
                            {{ $entrega->franja_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
