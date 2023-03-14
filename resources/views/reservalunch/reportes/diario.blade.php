<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aprobaciones de Lunches</title>
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
        <h4>REPORTE APROBACIONES DE LUNCHES</h4>
        <span><strong>Fecha: </strong>{{$fecha}}</span>
    </div>
<br>
    <div class="container">

        <table class="table table-bordered" style="width: 100%;">
            <thead>
                <tr style="background-color: #f0ecec;">
                    <td align="center"><b>NRO</b></td>
                    <td align="center"><b>CLIENTE</b></td>
                    <td align="center"><b>ESTADO</b></td>
                    <td align="center"><b>APROBADO POR</b></td>
                    <td align="center"><b>FIRMA</b></td>                    
                </tr>
            </thead>
            <tbody>
                @php
                $i=0;
                $total = 0;
                @endphp
                @foreach ($contenedor as $item)
                <tr>
                    <td align="center">{{++$i}}</td>
                    <td>{{$item['cliente']}}</td>
                    <td align="right">{{$item['estado']}}</td>
                    <td align="center">{{$item['user']}}</td>
                    <td></td>
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