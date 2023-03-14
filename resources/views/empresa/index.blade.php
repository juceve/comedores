@extends('adminlte::page')

@section('title')
EMPRESAS
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary mt-3">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Empresa') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('empresas.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
                                <i class="fas fa-plus"></i> Nuevo
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

                                    <th>NOMBRE</th>
                                    <th>GENERA REPORTE</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=0;
                                @endphp
                                @foreach ($empresas as $empresa)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $empresa->nombre }}</td>
                                    <td>{{ $empresa->reportes?'SI':'NO' }}</td>
                                    <td>
                                        <form action="{{ route('empresas.destroy',$empresa->id) }}" class="delete"
                                            onsubmit="return false" method="POST">
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('empresas.edit',$empresa->id) }}"><i
                                                    class="fa fa-fw fa-edit"></i> Editar</a>
                                            @csrf
                                            @method('DELETE')
                                            {{-- <button type="submit" class="btn btn-danger btn-sm" onclick="verifica();"><i
                                                    class="fa fa-fw fa-trash"></i> Eliminar</button> --}}
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
@if ($message = Session::get('success'))
<script>
    Swal.fire(
        'Excelente!',
        '{{$message}}',
        'success'
    );
</script>
@endif

@if ($message = Session::get('error'))
<script>
    Swal.fire(
        'Error!',
        '{{$message}}',
        'error'
    );
</script>
@endif

<script>
    $(document).ready(function() {
        var hoy = new Date();
    $('.dataTable').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        pageLength : 10,
        lengthMenu: [[5, 10, 20], [5, 10, 20]],
    } );
} );

$('.delete').submit(function(e){
    Swal.fire({
  title: 'ELIMINAR EMPRESA',
  text: "Esta seguro de realizar esta operación?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, eliminar',
  cancelButtonText: 'No, cancelar'
}).then((result) => {
  if (result.isConfirmed) {
    this.submit();
  }
})
});
</script>
@endsection