<div>
    <div class="card  card-success mt-3">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">

                <span id="card_title">
                    REPORTE DE APROBACIONES DE LUNCHES
                </span>

                 <div class="float-right">
                    <a href="reservalunches" class="btn btn-success btn-sm float-right"  data-placement="left">
                      <i class="fas fa-arrow-left"></i> {{ __('Volver') }}
                    </a>
                  </div>
            </div>
        </div>
        <div class="card-body">
            <div class="content">
                <div class="row">
                    <div class="col-12 col-md-3 mb-3">
                        <label for="">Fecha</label>
                        <input type="date" class="form-control " value="{{date('Y-m-d')}}" wire:model="fecha">
                    </div>
                    @if ($aprobaciones->count() > 0)
                    <div class="col-12 col-md-3 mb-3">
                        <label for="">Exportar</label><br>
                        {{-- <button class="btn btn-success" style="width: 100px;" wire:click='buscar'><i
                                class="fas fa-search"></i> Buscar</button> --}}
                        <button class="btn btn-danger btn-block"  wire:click='pdf'><i
                                class="fas fa-file-pdf"></i> PDF</button>
                    </div>
                    @endif
                </div>

            </div>
            <hr>

            @if ($aprobaciones->count() > 0)
            <div class="content text-center">
                <h4>REPORTE DIARIO DE APROBACIONES DE LUNCHES</h4>
                <span><strong>Fecha: </strong>{{$fecha}}</span>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr align="center" class="bg-secondary">
                            <th width='80'>NRO</th>
                            <th>CLIENTE</th>
                            <th>ESTADO</th>
                            <th>APROBADO POR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=0;
                        $total = 0;
                        @endphp
                        @foreach ($aprobaciones as $item)
                        <tr>
                            <td align="center">{{++$i}}</td>
                            <td>{{$item->cliente->nombre}}</td>
                            <td align="center">{{$item->estado?'APROBADO':'PENDIENTE'}}</td>
                            <td align="center">{{$item->user->name}}</td>
                        </tr>

                        @endforeach
                    </tbody>

                </table>
            </div>
            @endif

        </div>
    </div>

</div>
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
@endsection