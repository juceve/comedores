@extends('adminlte::page')

@section('title')
CLIENTES POR TURNO
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary mt-3">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Clientes por turno') }}
                        </span>

                        <div class="float-right">
                            <button class="btn btn-primary btn-sm float-right" data-placement="left" data-toggle="modal"
                                data-target="#modalNuevo">
                                <i class="fas fa-plus"></i> Nuevo
                            </button>
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
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Cliente</th>
                                    <th>Turno</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($clienteturnos->count() > 0)
                                @foreach ($clienteturnos as $clienteturno)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $clienteturno->cliente->nombre }}</td>
                                    <td>{{ $clienteturno->turno->nombre }}</td>

                                    <td>
                                        <form action="{{ route('clienteturnos.destroy',$clienteturno->id) }}"
                                            method="POST">
                                            <a class="btn btn-sm btn-primary "
                                                href="{{ route('clienteturnos.show',$clienteturno->id) }}"><i
                                                    class="fa fa-fw fa-eye"></i> Show</a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('clienteturnos.edit',$clienteturno->id) }}"><i
                                                    class="fa fa-fw fa-edit"></i> Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-fw fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $clienteturnos->links() !!}
        </div>
    </div>
</div>

{{-- MODALES --}}
<div class="modal fade" id="modalNuevo" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalNuevoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNuevoLabel">Seleccione un cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered table-sm dataTable">
                        <thead>
                            <tr>
                                <th>Nro</th>
                                <th>CLIENTE</th>
                                <th>EMPRESA</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($clientes->count() > 0)
                            @php
                            $i=0;
                            @endphp
                            @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$cliente->nombre}}</td>
                                <td>{{$cliente->empresa->nombre}}</td>
                                <td>
                                    <button class="btn btn-sm btn-success" title="Seleccionar"><i
                                            class="fas fa-check"></i></button>
                                </td>
                            </tr>
                            @endforeach

                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function () {
    $('.dataTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        pageLength : 5,
        lengthMenu: [[5, 10, 20], [5, 10, 20]],
    });
});
</script>
@endsection