<div>
    <div class="content">
        <label for="">Filtrar resultados:</label>
        <div class="row">
            <div class="col-12 col-md-3 mb-3">
                <label for="">Busqueda</label>
                <input type="search" class="form-control form-control-sm" wire:model='criterio'
                    placeholder="Cliente o Producto">
            </div>
            <div class="col-12 col-md-3 mb-3">
                <label for="">Del</label>
                <input type="date" class="form-control form-control-sm" value="{{date('Y-m-d')}}" wire:model="fechai">
            </div>
            <div class="col-12 col-md-3 mb-3">
                <label for="">al</label>
                <input type="date" class="form-control form-control-sm" value="{{date('Y-m-d')}}" wire:model="fechaf">
            </div>

            <div class="col-12 col-md-9 mb-3">
                <label for="">Empresas</label>
                <select class="select2" multiple="multiple" style="width: 100%" wire:model='selectedEmpresas'>
                    @if (!is_null($empresas))
                    @foreach ($empresas as $empresa)
                    <option value="{{$empresa->id}}">{{$empresa->nombre}}</option>
                    @endforeach
                    @endif

                </select>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="incluir" wire:model="incluirTodas">
                    <label class="form-check-label" for="incluir"><small>Incluir Contratistas</small></label>
                </div>
            </div>
            @if (count($entregas) >0)
            <div class="col-12 col-md-3 mb-3">
                <label for="">Exportar</label>

                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-danger btn-block" wire:click='pdf' wire:loading.attr='disabled'><i
                                class="fas fa-file-pdf"></i>
                            PDF</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-success btn-block" wire:click='excel'><i class="fas fa-file-excel"></i>
                            EXCEL</button>
                    </div>
                </div>

            </div>
            @endif

        </div>

    </div>
    @if (count($entregas) >0)
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="thead">
                <tr>
                    <th>ID</th>

                    <th>FECHA</th>
                    <th>CLIENTE</th>
                    <th>EMPRESA</th>
                    <th>PRODUCTO</th>

                    {{-- <th></th> --}}
                </tr>
            </thead>
            <tbody>

                @foreach ($entregas as $entrega)
                <tr>
                    <td>{{$entrega->id }}</td>

                    <td>{{ $entrega->created_at }}</td>
                    <td>{{ $entrega->cliente }}</td>
                    <td>{{ $entrega->empresa }}</td>
                    <td>{{ $entrega->franja }}</td>
                    <td>
                        @can('entregas.anular')
                        <button type="submit" class="btn btn-warning btn-sm" title="Anular"
                            onclick="anular({{$entrega->id}})"><i class="fa fa-fw fa-trash"></i></button>
                        @endcan

                    </td>
                </tr>
                @endforeach


            </tbody>
        </table>
        <div class="content">
            {!! $entregas->links() !!}
        </div>
    </div>
    @endif
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
});

Livewire.on('error',msg=>{
    Swal.fire('Error!', msg,'error');
})

function anular(id){
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
                Livewire.emit('anular',id);
            }
            });
}
</script>
@endsection