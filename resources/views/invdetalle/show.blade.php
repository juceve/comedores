@extends('layouts.app')

@section('template_title')
    {{ $invdetalle->name ?? 'Show Invdetalle' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Invdetalle</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('invdetalles.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $invdetalle->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Inventario Id:</strong>
                            {{ $invdetalle->inventario_id }}
                        </div>
                        <div class="form-group">
                            <strong>Producto Id:</strong>
                            {{ $invdetalle->producto_id }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $invdetalle->cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Subtotal:</strong>
                            {{ $invdetalle->subtotal }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
