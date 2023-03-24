@extends('layouts.app')

@section('template_title')
    {{ $mensualidade->name ?? 'Show Mensualidade' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Mensualidade</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('mensualidades.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $mensualidade->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Feccontrol:</strong>
                            {{ $mensualidade->feccontrol }}
                        </div>
                        <div class="form-group">
                            <strong>Importe:</strong>
                            {{ $mensualidade->importe }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
