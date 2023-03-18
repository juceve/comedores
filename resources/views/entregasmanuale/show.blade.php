@extends('layouts.app')

@section('template_title')
    {{ $entregasmanuale->name ?? 'Show Entregasmanuale' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Entregasmanuale</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('entregasmanuales.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Entregas Id:</strong>
                            {{ $entregasmanuale->entregas_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $entregasmanuale->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ip:</strong>
                            {{ $entregasmanuale->ip }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
