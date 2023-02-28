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
    <div class="content text-center">
        <h4>REPORTE DIARIO DE ENTREGAS</h4>
        <span><strong>Fecha: </strong>{{$fecha}}</span>
    </div>
<br>
    <div class="container">

        <table class="table table-bordered" style="width: 100%;">
            <thead>
                <tr style="background-color: #f0ecec;">
                    <td align="center"><b>NRO</b></td>
                    <td align="center"><b>PRODUCTO</b></td>
                    <td align="center"><b>PRECIO UNI.</b></td>
                    <td align="center"><b>CANTIDAD</b></td>
                    <td align="center"><b>SUBTOTAL</b></td>
                </tr>
            </thead>
            <tbody>
                @php
                $i=0;
                $total = 0;
                @endphp
                @foreach ($contenedor as $entrega)
                <tr>
                    <td align="center">{{++$i}}</td>
                    <td>{{$entrega['nombre']}}</td>
                    <td align="right">{{$entrega['precio']}}</td>
                    <td align="center">{{$entrega['cantidad']}}</td>
                    <td align="right">{{$entrega['total']}}</td>
                </tr>
                @php
                $total = $total + $entrega['total'];
                @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td align="center"><strong>TOTAL</strong></td>
                    <td align="right"><strong>{{number_format($total, 2, '.', ',')}}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>


</body>

</html>