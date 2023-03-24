<div class="mt-3">
    <div class="content">
        <div class="card card-success">
            <div class="card-header">
                REPORTE GENERAL POR EMPRESA
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
                        <div class="row">
                            <div class="col-12 col-md-9">
                                <select class="select2" multiple="multiple" style="width: 100%"
                                    wire:model='selectedEmpresas'>
                                    @if (!is_null($empresas))
                                    @foreach ($empresas as $empresa)
                                    <option value="{{$empresa->id}}">{{$empresa->nombre}}</option>
                                    @endforeach
                                    @endif

                                </select>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="incluir"
                                        wire:model="incluirTodas">
                                    <label class="form-check-label" for="incluir"><small>Incluir
                                            Contratistas</small></label>
                                </div>
                            </div>
                        </div>



                    </div>
                    @if (!is_null($contenedor))
                    <div class="col-12 col-md-3 mb-3">
                        <button class="btn btn-danger " style="width: 100%;" wire:click='pdf' wire:loading.attr="disabled"><i
                                class="fas fa-file-pdf"></i>
                            Exportar PDF</button>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <button class="btn btn-success " style="width: 100%;" wire:click='excel' wire:loading.attr="disabled"><i
                                class="fas fa-file-excel"></i>
                            Exportar Excel</button>
                    </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12">

            @if (!is_null($contenedor))
            <div class="card">
                <div class="card-body">
                    <h2 class="text-secondary text-center">REPORTE GENERAL POR EMPRESA</h2>
                    <h6 class="text-secondary text-center"><strong>Fecha: </strong>Del {{$fechai}} al {{$fechaf}}</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr class="bg-dark text-center">
                                    <th style="width: 250px;">EMPRESA</th>
                                    <th>CLIENTE/PRODUCTO</th>
                                    <th style="width: 150px">CANTIDAD</th>
                                    <th style="width: 150px">IMPORTE Bs.</th>
                                </tr>
                            </thead>

                            @php
                            $totalImporte = 0;
                            $b=0;
                            @endphp


                            @foreach ($contenedor as $item)
                                    @if ($b > 0)
                                    <tr >
                                        <td></td>
                                        <td align="right" class="table-secondary"><strong>TOTAL</strong></td>
                                        <td align="right" class="table-secondary"><strong>{{$totalclientecantidad}}</strong></td>
                                        <td align="right" class="table-secondary"><strong>{{number_format($totalclienteimporte, 2, '.', ',');}}</strong></td>
                                    </tr>
                                    <tr><td colspan="4"> </td></tr>
                                    @endif
                                    <tr class="table-secondary">
                                        <td><b> {{$item[0]}}</b></td>
                                        <td><b></b></td>
                                        <td align="right"><b> {{$item[1]}}</b></td>
                                        <td align="right"><b> {{number_format($item[3], 2, '.', ',');}}</b></td>
                                    </tr>
                                    <tr><td colspan="4"> </td></tr>
                                    @php
                                    $totalImporte = $totalImporte + $item[3];
                                    $datas = $item[2];

                                    @endphp

                                    @if (count($datas))
                                        @php
                                        $cliente = "";
                                        $b2 = 0;
                                        @endphp
                                        @foreach ($datas as $data)
                                            @if ($cliente != $data[0])                                        
                                                @if ($b2 > 0)
                                                    <tr >
                                                        <td></td>
                                                        <td align="right" class="table-secondary"><strong>TOTAL</strong></td>
                                                        <td align="right" class="table-secondary"><strong>{{$totalclientecantidad}}</strong></td>
                                                        <td align="right" class="table-secondary"><strong>{{number_format($totalclienteimporte, 2, '.', ',');}}</strong></td>
                                                    </tr>
                                                    <tr><td colspan="4"> </td></tr>
                                                @endif
                                                @php
                                                $cliente = $data[0];
                                                $totalclientecantidad = 0;
                                                $totalclienteimporte = 0;
                                                $b2++;
                                                @endphp
                                                <tr >
                                                    <td></td>
                                                    <td class="table-secondary"><strong>{{$data[0]}}</strong></td>
                                                    <td class="table-secondary"></td>
                                                    <td class="table-secondary"></td>
                                                </tr>
                                            @endif
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-2 col-md-6"></div>
                                                    <div class="col-10 col-md-6">
                                                        {{$data[1]}}
                                                    </div>
                                                </div>                                        
                                            </td>
                                            <td align="right">{{$data[2]}}</td>
                                            <td align="right">{{number_format($data[3], 2, '.', ',');}}</td>
                                        </tr>
                                        @php
                                            $totalclientecantidad = $totalclientecantidad + $data[2];
                                            $totalclienteimporte = $totalclienteimporte + $data[3];
                                        @endphp
                                        @endforeach
                                    @endif
                                        @php
                                            $b++;
                                        @endphp
                            @endforeach
                            <tr >
                                <td></td>
                                <td align="right" class="table-secondary"><strong>TOTAL</strong></td>
                                <td align="right" class="table-secondary"><strong>{{$totalclientecantidad}}</strong></td>
                                <td align="right" class="table-secondary"><strong>{{number_format($totalclienteimporte, 2, '.', ',');}}</strong></td>
                            </tr>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                    <td class="bg-dark" align="right"><b>IMPORTE TOTAL</b></td>
                                    <td class="bg-dark" align="right"><b>{{number_format($totalImporte, 2, '.',
                                            ',');}}</b>
                                    </td>
                                </tr>
                            </tfoot>


                        </table>
                    </div>

                </div>
            </div>
            @else
            <div class="content text-center">
                <span>Sin resultados para mostrar!</span>
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