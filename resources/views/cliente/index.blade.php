@extends('adminlte::page')

@section('title')
CLIENTES
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary mt-3">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            LISTADO DE CLIENTES
                        </span>

                        <div class="float-right">
                            <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                <i class="fas fa-plus"></i> {{ __('Nuevo') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Nombre</th>
                                    {{-- <th>Cargo</th> --}}
                                    <th>Empresa</th>
                                    {{-- <th>Cedula</th> --}}
                                    <th>Estado</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=0;
                                @endphp
                                @foreach ($clientes as $cliente)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $cliente->nombre }}</td>
                                    {{-- <td>{{ $cliente->cargo }}</td> --}}
                                    <td>{{ $cliente->empresa->nombre }}</td>
                                    {{-- <td>{{ $cliente->cedula }}</td> --}}
                                    <td>{{ $cliente->estado?'ACTIVO':'INACTIVO' }}</td>

                                    <td style="width: 150px;" align="right">
                                        <form action="{{ route('clientes.destroy',$cliente->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary "
                                                href="{{ route('clientes.show',$cliente->id) }}" title="Ver info"><i
                                                    class="fa fa-fw fa-eye"></i></a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('clientes.edit',$cliente->id) }}" title="Editar"><i
                                                    class="fa fa-fw fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Activar/Desactivar"><i class="fas fa-power-off"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        var hoy = new Date();
    $('.dataTable').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
        dom: 'lfrtipB',
        buttons: [{
        //Botón para Excel
        extend: 'excel',
        footer: true,
        title: 'LISTADO DE CLIENTES',
        filename: 'Clientes_'+ hoy.getDate() + ( hoy.getMonth() + 1 ) + hoy.getFullYear() + '_' +hoy.getHours() +  hoy.getMinutes() +  hoy.getSeconds(),

        //Aquí es donde generas el botón personalizado
        text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
      },
      //Botón para PDF
      {
        extend: 'pdf',
        footer: true,
        title: 'LISTADO DE CLIENTES',
        filename: 'Clientes_'+ hoy.getDate() + ( hoy.getMonth() + 1 ) + hoy.getFullYear() + '_' +hoy.getHours() +  hoy.getMinutes() +  hoy.getSeconds(),
        text: '<button class="btn btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>'
      }
    ]
    } );
} );
</script>
@endsection