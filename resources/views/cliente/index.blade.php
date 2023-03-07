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


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Nombre</th>
                                    {{-- <th>Cargo</th> --}}
                                    <th>Empresa</th>
                                    <th>Lunch</th>
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

                                    <td>
                                        @if ($cliente->lunch)
                                        <span style="width: 60px;" class="badge rounded-pill bg-success">Activo</span>
                                        @else
                                        <span style="width: 60px;"
                                            class="badge rounded-pill bg-secondary">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($cliente->estado)
                                        <span style="width: 60px;" class="badge rounded-pill bg-success">Activo</span>
                                        @else
                                        <span style="width: 60px;"
                                            class="badge rounded-pill bg-secondary">Inactivo</span>
                                        @endif
                                    </td>

                                    <td style="width: 150px;" align="right">

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('clientes.show',$cliente->id) }}"><i
                                                        class="fa fa-fw fa-eye text-gray"></i> Ver info</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('clientes.edit',$cliente->id) }}"><i
                                                        class="fa fa-fw fa-edit text-gray"></i> Editar</a>
                                                <form action="{{ route('lunch',$cliente->id) }}" onsubmit="return false"
                                                    method="POST" class="actdesc-lunch">
                                                    @csrf

                                                    <button type="submit" class="dropdown-item"><i
                                                            class="fas fa-power-off text-gray"></i> Act/Des
                                                        Lunch</button>
                                                </form>
                                                <form action="{{ route('clientes.destroy',$cliente->id) }}"
                                                    onsubmit="return false" method="POST" class="actdesc-cliente">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item"><i
                                                            class="fas fa-power-off text-gray"></i> Act/Des
                                                        Cliente</button>
                                                </form>
                                            </div>
                                        </div>
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
@if ($message = Session::get('success'))
<script>
    Swal.fire(
  'Excelente!',
  '{{ $message }}',
  'success'
)
</script>
@endif
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

<script>
    $('.actdesc-lunch').submit(function(e){
        Swal.fire({
        title: 'CAMBIAR ESTADO LUNCH',
        text: "Esta seguro de realizar esta operación?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar!',
        cancelButtonText: 'No, cancelar'
        }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
        })
    });

    $('.actdesc-cliente').submit(function(e){
        Swal.fire({
            title: 'CAMBIAR ESTADO CLIENTE',
        text: "Esta seguro de realizar esta operación?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar!',
        cancelButtonText: 'No, cancelar'
        }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
        })
    });
</script>
@endsection