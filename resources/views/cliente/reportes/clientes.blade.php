<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clientes</title>
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
<div class="table-responsive">
    <table class="table table-striped table-hover dataTable">
        <thead class="thead">
            <tr style="background-color: #d7d7d7">
                <th>No</th>                
                <th>Nombre</th>
                <th>Cargo</th>
                <th>Empresa</th>
                <th>Cedula</th>
                <th>Estado</th>

            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ ++$i }}</td>                    
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->cargo }}</td>
                    <td>{{ $cliente->empresa }}</td>
                    <td>{{ $cliente->cedula }}</td>
                    <td>{{ $cliente->estado }}</td>                    
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>

</html>