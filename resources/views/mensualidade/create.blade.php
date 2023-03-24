@extends('adminlte::page')

@section('title')
REGISTRO DE MENSUALIDAD
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-info mt-3">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                               REGISTRO DE MENSUALIDAD
                            </span>

                             <div class="float-right">
                                <a href="{{ route('mensualidades.index') }}" class="btn btn-info btn-sm float-right"  data-placement="left">
                                  <i class="fas fa-arrow-left"></i> {{ __('Volver') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('mensualidades.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('mensualidade.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
