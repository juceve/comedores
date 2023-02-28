<div>
    <div class="card  card-success mt-3">
        <div class="card-header">
            Reporte diario de Entregas
        </div>
        <div class="card-body">
            <div class="content">
                <div class="row">
                    <div class="col-12 col-md-3 mb-3">
                        <label for="">Fecha</label>
                        <input type="date" class="form-control " value="{{date('Y-m-d')}}" wire:model="fecha">
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label for="">Franjas</label>
                        <select class="select2" multiple="multiple" style="width: 100%" wire:model='selectedFranjas'>
                            @foreach ($franjas as $franja)
                            <option value="{{$franja->id}}">{{$franja->nombre}}</option>
                            @endforeach

                        </select>

                    </div>
                    <div class="col-12 col-md-3 mb-3">
                        <label for="">Exportar</label><br>
                        {{-- <button class="btn btn-success" style="width: 100px;" wire:click='buscar'><i
                                class="fas fa-search"></i> Buscar</button> --}}
                        <button class="btn btn-danger " style="width: 100px;" wire:click='pdf'><i
                                class="fas fa-file-pdf"></i> PDF</button>
                    </div>
                </div>

            </div>
            <hr>
            <div class="content text-center">
                <h4>REPORTE DIARIO DE ENTREGAS</h4>
                <span><strong>Fecha: </strong>{{$fecha}}</span>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr align="center" class="bg-secondary">
                            <th width='80'>NRO</th>
                            <th>PRODUCTO</th>
                            <th width='120'>PRECIO UNI.</th>
                            <th width='120'>CANTIDAD</th>
                            <th width='120'>SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=0;
                        $total = 0;
                        @endphp
                        @foreach ($contenedor as $entrega)
                        <tr>
                            <td align="center">{{++$i}}</td>
                            <td>{{$entrega['nombre']}}</td>
                            <td align="right">{{$entrega['precio']}}</td>
                            <td align="center">{{$entrega['cantidad']}}</td>
                            <td align="right">{{$entrega['total']}}</td>
                        </tr>
                        @php
                        $total = $total + $entrega['total'];
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td align="center"><strong>TOTAL</strong></td>
                            <td align="right"><strong>{{number_format($total, 2, '.', ',')}}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
@section('js')
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('.select2').on('change', function (e) {
            let data = $(this).val();
                @this.set('selectedFranjas', data);
        });
    });

    Livewire.on('updateSelect2',()=>{
        $('.select2').select2();
    })
</script>
@endsection