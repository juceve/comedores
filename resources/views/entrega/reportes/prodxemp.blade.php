<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Productos por Empresas</title>
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
        <h4>REPORTE DE PRODUCTOS ENTREGADOS POR EMPRESA</h4>
        <span><strong>Fecha: </strong>Del {{$fechai}} al {{$fechaf}}</span>
    </div>
<br>
    <div class="container">

        <table class="table table-bordered" style="width: 100%;">
            <thead>
                <tr style="background-color: #575757">
                    <td align="center"><b> <font color='#FFF'> EMPRESA</font></b></td>
                    <td align="center"><b><font color='#FFF'> PRODUCTO</font></b></td>
                    <td align="center" style="width: 150px"><b> <font color='#FFF'> CANTIDAD</font></b></td>
                    <td align="center" style="width: 150px"><b> <font color='#FFF'> IMPORTE Bs.</font></b></td>
                </tr>
            </thead>
            <tbody>
                @if (!is_null($contenedor))
                            @php
                            $totalImporte = 0;
                            @endphp
                            @foreach ($contenedor as $item)
                            <tr style="background-color: #f0ecec;">
                                <td colspan="2"><b> {{$item[0]}}</b></td>
                                <td align="right"><b> {{$item[1]}}</b></td>
                                <td align="right"><b> {{number_format($item[3], 2, '.', '');}}</b></td>
                            </tr>
                            @php
                            $totalImporte = $totalImporte + $item[3];
                            @endphp
                            @php
                            $datas = $item[2];
                            @endphp
                            @foreach ($datas as $data)
                            <tr>
                                <td></td>
                                <td>{{$data[0]}}</td>
                                <td align="right">{{$data[1]}}</td>
                                <td align="right">{{$data[2]}}</td>
                            </tr>
                            @endforeach
                            @endforeach
                            @endif
                            
                                
                            
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td align="right" style="background-color: #575757"><font color="#fff" > <b>IMPORTE TOTAL</b></font></td>
                    <td align="right" style="background-color: #575757"><font color="#fff" > <b>{{number_format($totalImporte, 2, '.',
                            '');}}</b></font>
                    </td>
                </tr>
            </tfoot>
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