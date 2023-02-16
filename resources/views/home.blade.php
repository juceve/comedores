@extends('adminlte::page')
@section('css')
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection
@section('content')
<div class="container-fluid">
    <h2 class="mt-2 text-secondary text-center">Bienvenido al Control de Comedores</h2>
    <hr>
    <h4 class="text-secondary">Entregas de Hoy</h4>
    <div class="row mt-3">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$desayunos->count()}}</h3>

                    <p>Desayunos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-coffee"></i>
                </div>
                <a href="/entregas" class="small-box-footer">Mas información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6 ">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$almuerzos->count()}}</h3>

                    <p>Almuerzos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-pizza-slice"></i>
                </div>
                <a href="/entregas" class="small-box-footer">Mas información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$cenas->count()}}</h3>

                    <p>Cenas</p>
                </div>
                <div class="icon">
                    <i class="fas fa-hamburger"></i>
                </div>
                <a href="/entregas" class="small-box-footer">Mas información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$lunch->count()}}</h3>

                    <p>Lunch's</p>
                </div>
                <div class="icon">
                    <i class="fas fa-cookie"></i>
                </div>
                <a href="/entregas" class="small-box-footer">Mas información <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

    </div>
</div>
@endsection