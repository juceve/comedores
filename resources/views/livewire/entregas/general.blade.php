<div class="mt-3">
    <div class="content">
        <div class="card card-success">
            <div class="card-header">
                REPORTE GENERAL POR CLIENTES
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
                    <div class="col-12 col-md-6 mb-3">
                        <label for="">Empresas</label>
                        <select class="select2" multiple="multiple" style="width: 100%" wire:model='selectedEmpresas'>
                            @if (!is_null($empresas))
                            @foreach ($empresas as $empresa)
                            <option value="{{$empresa->id}}">{{$empresa->nombre}}</option>
                            @endforeach
                            @endif

                        </select>

                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <button class="btn btn-danger " style="width: 100%;" wire:click='pdf'><i
                                class="fas fa-file-pdf"></i>
                            Exportar PDF</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12">
            
        @if (!is_null($contenedor))
            <div class="card">
                <div class="card-body">
                    <h2 class="text-secondary text-center">REPORTE DE PRODUCTOS ENTREGADOS POR EMPRESA</h2>
                    <h6 class="text-secondary text-center"><strong>Fecha: </strong>Del {{$fechai}} al {{$fechaf}}</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-dark text-center">
                                    <th>EMPRESA</th>
                                    <th>PRODUCTO</th>
                                    <th style="width: 150px">CANTIDAD</th>
                                    <th style="width: 150px">IMPORTE Bs.</th>
                                </tr>
                            </thead>
                            
                                @php
                                $totalImporte = 0;
                                @endphp
                                @foreach ($contenedor as $item)
                                    <tr class="table-secondary">
                                        <td colspan="2"><b> {{$item[0]}}</b></td>
                                        <td align="right"><b> {{$item[1]}}</b></td>
                                        <td align="right"><b> {{number_format($item[3], 2, '.', '');}}</b></td>
                                    </tr>
                                    @php
                                        $totalImporte = $totalImporte + $item[3];                                    
                                        $datas = $item[2];
                                    @endphp
                                    @if (count($datas))
                                        @foreach ($datas as $data)
                                        <tr>
                                            <td></td>
                                            <td>{{$data[0]}}</td>
                                            <td align="right">{{$data[1]}}</td>
                                            <td align="right">{{$data[2]}}</td>
                                        </tr>
                                        @endforeach
                                    @endif

                                @endforeach
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td class="bg-dark" align="right"><b>IMPORTE TOTAL</b></td>
                                        <td class="bg-dark" align="right"><b>{{number_format($totalImporte, 2, '.',
                                                '');}}</b>
                                        </td>
                                    </tr>
                                </tfoot>
                            
                            
                        </table>
                    </div>

                </div>
            </div>
            @endif
        </div>

    </div>
    @section('js')
    <script>
        $(document).ready(function() {
        $('.select2').select2();
        $('.select2').on('change', function (e) {
            let data = $(this).val();
                @this.set('selectedEmpresas', data);
        });
    });

    Livewire.on('updateSelect2',()=>{
        $('.select2').select2();
    })
    </script>
    @endsection