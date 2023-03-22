<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Entregas Manuales</title>
    <link href="{{public_path('invoice/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
    <script src="{{public_path('invoice/bootstrap.min.js')}}"></script>
    <script src="{{public_path('invoice/jquery-1.11.1.min.js')}}"></script>
    <style>
        .invoice-title h2,
        .invoice-title h3 {
            display: inline-block;
        }

        .table>tbody>tr>.no-line {
            border-top: none;
        }

        .table>thead>tr>.no-line {
            border-bottom: none;
        }

        .table>tbody>tr>.thick-line {
            border-top: 2px solid;
        }
    </style>
</head>

<body>
    <img src="{{asset('images/logoAR.png')}}" style="width: 120px;">
    <div class="content text-center">
        <h4>REPORTE DE ENTREGAS MANUALES</h4>
        <span>Del {{$fechai}} al {{$fechaf}}</span>
    </div>
<br>
    <div class="container">

        <table class="table table-striped table-hover dataTable" style="font-size: 11px;">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Registro Manual</th>
                    <th>Entrega Producto</th>
                    <th>Cliente</th>
                    <th>Empresa</th>
                    <th>Producto</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 0;
                @endphp
                @foreach ($entregasmanuales as $entregam)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $entregam['created_at'] }}</td>
                    <td>{{ $entregam['fechoraentrega'] }}</td>
                    <td>{{ $entregam['cliente'] }}</td>
                    <td>{{ $entregam['empresa'] }}</td>
                    <td>{{ $entregam['franja'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<footer>
    <br><br><br><br><br><br>
    <table style="width: 100%">
        <tr>
            <td align="center">
                ______________________ <br>
                Autorizado por
            </td>
            <td align="center">
                ______________________ <br>
                Firma Supervisor
            </td>
        </tr>
    </table>
</footer>
</body>

</html>