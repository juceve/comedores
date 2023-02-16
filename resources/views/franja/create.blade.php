@extends('adminlte::page')

@section('title')
    Nueva Franja
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-primary mt-3">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                FORMULARIO DE REGISTRO DE FRANJAS
                            </span>

                             <div class="float-right">
                                <a href="{{ route('franjas.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  <i class="fas fa-arrow-left"></i> Volver
                                </a>
                              </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('franjas.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('franja.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
