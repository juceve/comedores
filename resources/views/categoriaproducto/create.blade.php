@extends('adminlte::page')

@section('title')
    Registro Categoria
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header bg-success">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Registro de Categoria') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('categoriaproductos.index') }}" class="btn btn-success btn-sm float-right"  data-placement="left">
                                  <i class="fas fa-arrow-left"></i> Volver
                                </a>
                              </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('categoriaproductos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('categoriaproducto.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
