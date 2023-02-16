@extends('adminlte::page')

@section('title')
    Editar Franja
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-primary mt-3">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                 FORMULARIO DE EDICIÓN DE FRANJA
                            </span>

                             <div class="float-right">
                                <a href="{{ route('franjas.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  <i class="fas fa-arrow-left"></i> Volver
                                </a>
                              </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('franjas.update', $franja->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('franja.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
