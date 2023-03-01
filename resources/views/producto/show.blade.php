@extends('adminlte::page')

@section('title')
Info producto
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-success mt-3">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Información de Producto') }}
                            </span>
    
                            <div class="float-right">
                                <a href="{{ route('productos.index') }}"
                                    class="btn btn-success btn-sm float-right" data-placement="left">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $producto->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Categoria:</strong>
                            {{ $producto->categoriaproducto->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Precio venta:</strong>
                            {{ $producto->precioventa }}
                        </div>
                        <div class="form-group">
                            <strong>Precio compra:</strong>
                            {{ $producto->preciocompra }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
