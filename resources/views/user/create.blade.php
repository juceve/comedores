@extends('adminlte::page')

@section('title')
CREAR USUARIO
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-secondary mt-3">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Crear Usuario
                            </span>
    
                            <div class="float-right">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm float-right"
                                    data-placement="left">
                                    <i class="fas fa-arrow-left"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('user.form')

                        </form>
                        <small>El Usuario nuevo se creará con la contraseña por defecto.</small>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
