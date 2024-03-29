<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Entregas</title>
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
    <div class="content text-center mb-3">
        <h2>LISTADO DE ENTREGAS</h2>
        <small>Del {{$fechai}} al {{$fechaf}} </small><br>
    </div>
    <hr>
    <table class="table table-striped table-bordered" style="font-size: 11px;">
        <thead style="background-color: #d1d1d1;">
            <tr>
                <th>Nro</th>

                <th>FECHA</th>
                <th>CLIENTE</th>
                <th>PRODUCTO</th>
                <th>EMPRESA</th>
                <th>ESTADO</th>
            </tr>
        </thead>
        <tbody>
            @if (!is_null($entregas))
            @php
                $i=0;
            @endphp
            @foreach ($entregas as $entrega)
            <tr>
                <td>{{++$i }}</td>

                <td>{{ $entrega->created_at }}</td>
                <td>{{ $entrega->cliente }}</td>
                <td>{{ $entrega->franja }}</td>
                <td>{{ $entrega->empresa }}</td>
                <td>{{ $entrega->estado?'ACTIVO':'ANULADO' }}</td>

            </tr>
            @endforeach
            @endif

        </tbody>
    </table>
</body>

</html>