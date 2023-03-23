<div>
    {{-- @if(!auth()->user()->can('entregas.entregasmanuales'))
    @php
    return redirect()->route('noautorizado');
    @endphp
    @endif --}}
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-sm-12">
                @can('entregas.crearentregas')
                <div class="card card-primary">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                REGISTRO DE ENTREGA MANUAL
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

                                <div class="col-12 mb-2">
                                    <input class="form-control" type="text" placeholder="Nombre Cliente" readonly
                                        wire:model='nombre'>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3 mb-2">
                                    <input type="date" class="form-control" wire:model='fechaEntrega'>
                                </div>
                                <div class="col-12 col-md-3 mb-2">
                                    <input type="time" class="form-control" wire:model='horaEntrega'>
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
                    </div>
                </div>
                @endcan
                <div class="card card-secondary">
                    <div class="card-header text-center">
                        LISTADO DE ENTREGAS MANUALES
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-3 mb-3">
                                <label for="">Fecha Inicio</label>
                                <input type="date" class="form-control " value="{{date('Y-m-d')}}" wire:model="fechai">
                            </div>
                            <div class="col-12 col-md-3 mb-3">
                                <label for="">Fecha Fin</label>
                                <input type="date" class="form-control " value="{{date('Y-m-d')}}" wire:model="fechaf">
                            </div>
                            <div class="col-12 col-md-3 mb-3">
                                <label for="">Franjas</label>
                                <select class="form-control" style="width: 100%" wire:model='selFranja'>
                                    <option value="">Todos</option>
                                    @foreach ($franjas as $franja)
                                    <option value="{{$franja->id}}">{{$franja->nombre}}</option>
                                    @endforeach

                                </select>

                            </div>
                            @if (count($entregasmanuales) > 0)
                            <div class="col-12 col-md-3 mb-3">
                                <label for="">Exportar</label>
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-danger btn-block" wire:click='pdf'><i
                                                class="fas fa-file-pdf"></i>
                                            PDF</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-success btn-block" wire:click='excel'><i
                                                class="fas fa-file-excel"></i>
                                            Excel</button>
                                    </div>
                                </div>

                            </div>
                            @endif


                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover dataTable">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Registro Manual</th>
                                        <th>Entrega Producto</th>
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
                                        <td>{{ $entregam->fechoraentrega }}</td>
                                        <td>{{ $entregam->cliente }}</td>
                                        <td>{{ $entregam->empresa }}</td>
                                        <td>{{ $entregam->franja }}</td>
                                        <td align="right">
                                            @can('entregas.anular')
                                            <button class="btn btn-warning btn-sm" onclick="eliminar({{$entregam->id}})"
                                                title="Anular">
                                                <i class="fa fa-fw fa-trash"></i>

                                            </button>
                                            @endcan

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
                'searching' : false,
                "lengthChange": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                pageLength : 5,
                lengthMenu: [[5, 10, 20], [5, 10, 20]],
            });

            $('.select2').select2();
        $('.select2').on('change', function (e) {
            let data = $(this).val();
                @this.set('selectedFranjas', data);
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
                'searching' : false,
                "lengthChange": false,
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

    Livewire.on('updateSelect2',()=>{
        $('.select2').select2();
    })
</script>
@endsection