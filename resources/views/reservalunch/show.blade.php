@extends('layouts.app')

@section('template_title')
    {{ $reservalunch->name ?? 'Show Reservalunch' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Reservalunch</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('reservalunches.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Cliente Id:</strong>
                            {{ $reservalunch->cliente_id }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $reservalunch->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $reservalunch->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $reservalunch->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
