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
            </div>
            @if (count($entregas) >0)
            <div class="col-12 col-md-3 mb-3">
                <label for="">Exportar</label>

                <div class="row">
                    <div class="col-6">
                        <button class="btn btn-danger btn-block" wire:click='pdf'><i class="fas fa-file-pdf"></i>
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

                    <th>FECHA - HORA</th>
                    <th>CLIENTE</th>
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
                    <td>{{ $entrega->franja }}</td>

                    {{-- <td style="width: 200px" align="right"> --}}
                        {{-- <form action="{{ route('entregas.destroy',$entrega->id) }}" method="POST">
                            <a class="btn btn-sm btn-primary " href="{{ route('entregas.show',$entrega->id) }}"
                                title="Ver Info"><i class="fa fa-fw fa-eye"></i></a>
                            <a class="btn btn-sm btn-success" href="{{ route('entregas.edit',$entrega->id) }}"
                                title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"
                                    title="Eliminar"></i></button>
                        </form> --}}
                        {{-- </td> --}}
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
})
</script>
@endsection