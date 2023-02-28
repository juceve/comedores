@extends('layouts.app')

@section('template_title')
    {{ $kiosko->name ?? 'Show Kiosko' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Kiosko</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('kioskos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $kiosko->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Ubicacion:</strong>
                            {{ $kiosko->ubicacion }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $kiosko->estado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
