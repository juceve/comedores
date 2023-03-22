<table class="table table-striped table-bordered">
    <tr>
        <td align="center" colspan="4">
            LISTADO DE ENTREGAS       
        </td>
    </tr>
    <tr>
        <td align="center" colspan="4">
            Del {{$fechai}} al {{$fechaf}}
        </td>
    </tr>
    <thead style="background-color: #d1d1d1;">
        <tr>
            <th>Nro</th>

            <th>FECHA</th>
            <th>CLIENTE</th>
            <th>PRODUCTO</th>

        </tr>
    </thead>
    <tbody>
        @if (!is_null($entregas))
        @php
            $i=0;
        @endphp
        @foreach ($entregas as $entrega)
        <tr>
            <td>{{++$i }}</td>

            <td>{{ $entrega->created_at }}</td>
            <td>{{ $entrega->cliente }}</td>
            <td>{{ $entrega->franja }}</td>


        </tr>
        @endforeach
        @endif

    </tbody>
</table>