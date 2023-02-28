@extends('layouts.app')

@section('template_title')
    {{ $inventario->name ?? 'Show Inventario' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Inventario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('inventarios.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $inventario->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Kiosko Id:</strong>
                            {{ $inventario->kiosko_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $inventario->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $inventario->estado }}
                        </div>
                        <div class="form-group">
                            <strong>Cierre:</strong>
                            {{ $inventario->cierre }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
