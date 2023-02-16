@extends('adminlte::page')

@section('title')
Entregas
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary mt-3">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            LISTADO DE ENTREGAS
                        </span>

                        <div class="float-right">
                            {{-- <a href="{{ route('entregas.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                <i class="fas fa-plus"></i> Nuevo
                            </a> --}}
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                   
                    @livewire('entregas.listado')
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
        exportOptions: {
            columns: ':not(:last-child)',
        },
        //Aquí es donde generas el botón personalizado
        text: '<button class="btn btn-success">Exportar a Excel <i class="fas fa-file-excel"></i></button>'
      },
      //Botón para PDF
      {
        extend: 'pdf',
        footer: true,
        title: 'LISTADO DE CLIENTES',
        filename: 'Clientes_'+ hoy.getDate() + ( hoy.getMonth() + 1 ) + hoy.getFullYear() + '_' +hoy.getHours() +  hoy.getMinutes() +  hoy.getSeconds(),
        exportOptions: {
            columns: ':not(:last-child)',
        },
        text: '<button class="btn btn-danger">Exportar a PDF <i class="far fa-file-pdf"></i></button>'
      }
    ]
    } );
} );
</script>
@endsection