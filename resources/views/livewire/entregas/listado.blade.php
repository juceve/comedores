<div>
    <div class="content">
        <label for="">Filtrar resultados:</label>
        <div class="row">
            <div class="col-12 col-md-3 mb-3">
                <label for="">Busqueda</label>
                <input type="search" class="form-control form-control-sm" wire:model='criterio' placeholder="Cliente o Producto">
            </div>
            <div class="col-12 col-md-3 mb-3">
                <label for="">Del</label>
                <input type="date" class="form-control form-control-sm" value="{{date('Y-m-d')}}" wire:model="fechai">  
            </div>
            <div class="col-12 col-md-3 mb-3">
                <label for="">al</label>
                <input type="date" class="form-control form-control-sm" value="{{date('Y-m-d')}}" wire:model="fechaf">
            </div>
            
            <div class="col-12 col-md-3 mb-3">
                <label for="">Exportar</label><br>
                {{-- <button class="btn btn-success btn-sm" style="width: 50px;">Excel</button> --}}
                <button class="btn btn-danger btn-sm" style="width: 50px;" wire:click='pdf'>PDF</button>
            </div>
        </div>

    </div>
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
                @if (!is_null($entregas))
                    @foreach ($entregas as $entrega)
                <tr>
                    <td>{{$entrega->id }}</td>

                    <td>{{ $entrega->created_at }}</td>
                    <td>{{ $entrega->cliente }}</td>
                    <td>{{ $entrega->franja }}</td>

                    {{-- <td style="width: 200px" align="right"> --}}
                        {{-- <form action="{{ route('entregas.destroy',$entrega->id) }}" method="POST">
                            <a class="btn btn-sm btn-primary "
                                href="{{ route('entregas.show',$entrega->id) }}" title="Ver Info"><i
                                    class="fa fa-fw fa-eye"></i></a>
                            <a class="btn btn-sm btn-success"
                                href="{{ route('entregas.edit',$entrega->id) }}" title="Editar"><i
                                    class="fa fa-fw fa-edit"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i
                                    class="fa fa-fw fa-trash" title="Eliminar"></i></button>
                        </form> --}}
                    {{-- </td> --}}
                </tr>
                @endforeach
                @endif
                
            </tbody>
        </table>
        <div class="content">
            {!! $entregas->links() !!}
        </div>
    </div>
</div>
