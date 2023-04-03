<table class="table table-striped table-hover dataTable">
    <tr>
        <td colspan="6" align="center">REPORTE DE ENTREGAS MANUALES</td>        
    </tr>
    <tr>
        <td colspan="6" align="center">Del {{$fechai}} al {{$fechaf}}</td>
    </tr>
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
            <td>{{ $entregam['created_at'] }}</td>
            <td>{{ $entregam['fechoraentrega'] }}</td>
            <td>{{ $entregam['cliente'] }}</td>
            <td>{{ $entregam['empresa'] }}</td>
            <td>{{ $entregam['franja'] }}</td>
            <td align="right">
                @can('entregas.anular')
                <button class="btn btn-warning btn-sm" onclick="eliminar({{$entregam['id']}})"
                    title="Anular">
                    <i class="fa fa-fw fa-trash"></i>

                </button>
                @endcan

            </td>
        </tr>
        @endforeach
    </tbody>
</table>