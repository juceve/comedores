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
    <hr>


    <div class="row">
        <div class="col-12">
            <h4>Entregas Mensuales</h4>
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Cantidad de Entregas por Empresa</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="" style="height: 500px;">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>



</div>
@endsection
@section('js')
<script>
    const ctx = document.getElementById('myChart');
    var empresas = "{{$empresa}}";
    var cantidad = "{{$cantidad}}";
    var labels = empresas.split("|");
    var data = cantidad.split("|");
    // console.log(labels);
    new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
        label: 'Cant. Entregas',
        data: data,
        borderWidth: 1
        }]
    },
    options: {
        scales: {
        y: {
            beginAtZero: true
        }
        }
    }
    });
</script>
@endsection
@section('plugins.Chartjs', true)