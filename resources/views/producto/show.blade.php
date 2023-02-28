@extends('layouts.app')

@section('template_title')
    {{ $producto->name ?? 'Show Producto' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Producto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('productos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $producto->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Categoriaproducto Id:</strong>
                            {{ $producto->categoriaproducto_id }}
                        </div>
                        <div class="form-group">
                            <strong>Precioventa:</strong>
                            {{ $producto->precioventa }}
                        </div>
                        <div class="form-group">
                            <strong>Preciocompra:</strong>
                            {{ $producto->preciocompra }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
