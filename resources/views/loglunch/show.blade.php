@extends('layouts.app')

@section('template_title')
    {{ $loglunch->name ?? 'Show Loglunch' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Loglunch</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('loglunches.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $loglunch->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Cliente Id:</strong>
                            {{ $loglunch->cliente_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $loglunch->user_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
