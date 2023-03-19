<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary mt-3">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('ENTREGAS MANUALES') }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="content">
                            <div class="row mb-3">
                                <div class="col-12 col-md-6 ">
                                    <div class="input-group ">
                                        <input type="search" class="form-control" placeholder="Buscar por cedula"
                                            aria-label="Recipient's username" aria-describedby="button-addon2"
                                            wire:model='busqueda' wire:keydown.enter="buscarCliente">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" type="button" id="button-addon2"
                                                data-placement="left" data-toggle="modal" data-target="#modalNuevo"><i
                                                    class="fas fa-search"></i> Avanzada</button>
                                        </div>
                                    </div>
                                </div>                                
                            </div>

                            <div class="row">

                                <div class="col-12 col-md-3 mb-2">
                                    <input class="form-control" type="text" placeholder="Nombre Cliente" readonly
                                        wire:model='nombre'>
                                </div>
                                <div class="col-12 col-md-3 mb-2">
                                    <input type="date" class="form-control" wire:model='fechaEntrega'>
                                </div>
                                <div class="col-12 col-md-3 mb-2">
                                    <select class="form-control" wire:model='selFranja'>
                                        <option value="">Seleccione un Producto</option>
                                        @if (!is_null($franjas))
                                        @foreach ($franjas as $franja)
                                        <option value="{{$franja->id}}">{{$franja->nombre}}</option>
                                        @endforeach
                                        @endif

                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <button class="btn btn-success btn-block" wire:click='save'><i
                                            class="fas fa-save"></i> Registrar Entrega</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive" wire:ignore>
                            <table class="table table-striped table-hover dataTable">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Registro</th>
                                        <th>Entrega</th>
                                        <th>Cliente</th>
                                        <th>Empresa</th>
                                        <th>Producto</th>
                                        <th style="width: 80px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach ($entregasmanuales as $entregam)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $entregam->created_at }}</td>
                                        <td>{{ $entregam->fechaentrega }}</td>
                                        <td>{{ $entregam->cliente }}</td>
                                        <td>{{ $entregam->empresa }}</td>
                                        <td>{{ $entregam->franja }}</td>
                                        <td align="right">
                                            <button class="btn btn-warning btn-sm"
                                                onclick="eliminar({{$entregam->id}})"
                                                title="Anular">
                                                <i class="fa fa-fw fa-trash"></i>

                                            </button>
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

    {{-- MODALES --}}
    <div class="modal fade" id="modalNuevo" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="modalNuevoLabel" aria-hidden="true" wire:ignore>
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
                                    <th>CEDULA</th>
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
                                    <td>{{$cliente->cedula}}</td>
                                    <td>{{$cliente->empresa->nombre}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-success" title="Seleccionar"
                                            wire:click='seleccionar({{$cliente->id}})'><i
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    {{-- <div class="modal fade" id="modalCambioTurno" tabindex="-1" aria-labelledby="modalCambioTurnoLabel"
        aria-hidden="true" wire:ignore>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCambioTurnoLabel">Cambiar Turno de Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-2">
                            <label for="">Cliente</label>
                        </div>
                        <div class="col-12 col-md-6 mb-2">
                            <input type="text" class="form-control" readonly wire:model='cnombrecliente'>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="">Turno</label>
                        </div>
                        <div class="col-12 col-md-6">
                            <select class="form-control" wire:model='cselTurno'>
                                <option value="">Seleccione un turno</option>
                                @if (!is_null($franjas))
                                @foreach ($franjas as $franja)
                                <option value="{{$franja->id}}">{{$franja->nombre}}</option>
                                @endforeach
                                @endif

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="width: 100px;">Cerrar</button>
                    <button type="button" class="btn btn-primary" style="width: 100px;"
                        wire:click='cambiarTurno'>Guardar</button>
                </div>
            </div>
        </div>
    </div> --}}

</div>
@section('js')
@if ($message = Session::get('success'))
<script>
    Swal.fire('Excelente','{{$message}}','success');
</script>
@endif
<script>
    $(document).ready(function () {
            $('.dataTable').DataTable({
                'processing': true,
                dom: 'Bfrtip',
                buttons: [
                   'excel'
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                pageLength : 5,
                lengthMenu: [[5, 10, 20], [5, 10, 20]],
            });
        });
        Livewire.on('error', msg =>{
            Swal.fire('Atención',msg,'error');
        });
        
        Livewire.on('cerrarModal', msg =>{
            $('#modalNuevo').modal('hide');
        });

        Livewire.on('datatables',msg=>{
            $('.dataTable').DataTable({
                destroy: true,
                'processing': true,
                dom: 'Bfrtip',
                buttons: [
                    'excel'
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                pageLength : 5,
                lengthMenu: [[5, 10, 20], [5, 10, 20]],
            });
        });
</script>
<script>
    function eliminar(id){
        Swal.fire({
            title: 'Anular Entrega',
            text: "Está seguro de anular el registro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, anular',
            cancelButtonText: 'No, cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                Livewire.emit('remover',id);
            }
            });
    }
</script>
@endsection