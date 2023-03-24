@extends('adminlte::page')

@section('title')
RESERVAS
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary mt-2">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Reserva') }}
                        </span>

                    </div>
                </div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Franja</th>
                                    <th>Estado</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=0;
                                @endphp
                                @foreach ($reservas as $reserva)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $reserva->fecha }}</td>
                                    <td>{{ $reserva->cliente->nombre }}</td>
                                    <td>{{ $reserva->franja->nombre }}</td>
                                    <td>
                                        @if ($reserva->estado)
                                        <span style="width: 70px;" class="badge rounded-pill bg-success">Aprobado</span>
                                        @else
                                        <span style="width: 70px;"
                                            class="badge rounded-pill bg-secondary">Pendiente</span>
                                        @endif
                                    </td>

                                    <td style="width: 220px;">
                                        <div class="row mr-1" style="width: 210px; float: right">
                                            <div class="col-6">
                                                <form action="{{ route('approved',$reserva->id) }}" method="POST"
                                                    onsubmit="return false" class="prevConfirm">
                                                    @csrf
                                                    @can('reservas.approve')
                                                    <button style="width: 100px;" type="submit"
                                                        class="btn btn-primary btn-sm"><i class="fas fa-check"></i>
                                                        Aprobar</button>
                                                    @endcan

                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <form action="{{ route('reservas.destroy',$reserva->id) }}"
                                                    method="POST" onsubmit="return false" class="eliminar">
                                                    @csrf
                                                    @method('DELETE')
                                                    @can('reservas.destroy')
                                                    <button style="width: 100px;" type="submit"
                                                        class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i>
                                                        Eliminar</button>
                                                    @endcan

                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($reservas->count() > 0)
                    <div class="row">
                        <div class="col-12 col-md-4 mt-3">
                            <form action="{{ route('approvedAll') }}" method="POST" onsubmit="return false"
                                class="prevConfirmAll">
                                @csrf
                                @can('reservas.approve')
                                <button class="btn btn-success btn-block"><i class="fas fa-check-double"></i> Aprobar
                                    Todo</button>
                                @endcan

                            </form>
                        </div>
                    </div>
                    @endif
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
@if ($message = Session::get('error'))
<script>
    Swal.fire(
  'Error!',
  '{{ $message }}',
  'error'
)
</script>
@endif
<script>
    $('.dataTable').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        pageLength : 10,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],        
    });

    $('.prevConfirm').submit(function(){
        Swal.fire({
        title: 'APROBAR RESERVA',
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
    $('.prevConfirmAll').submit(function(){
        Swal.fire({
        title: 'APROBAR TODAS LAS RESERVAS',
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
    $('.eliminar').submit(function(){
        Swal.fire({
        title: 'ELIMINAR RESERVA',
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