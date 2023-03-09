<table>
    <tr>
        <td colspan="5" align="center">REPORTE DE ENTREGAS</td>        
    </tr>
    <tr>
        <td colspan="5" align="center">Del {{$fechai}} al {{$fechaf}}</td>
    </tr>
    <thead>
        <tr>
            <td>NRO</td>
            <td>PRODUCTO</td>
            <td>PRECIO UNI.</td>
            <td>CANTIDAD</td>
            <td>SUBTOTAL</td>
        </tr>
    </thead>
    <tbody>
        @php
        $i=0;
        $total = 0;
        @endphp
        @foreach ($contenedor as $entrega)
        <tr>
            <td>{{++$i}}</td>
            <td>{{$entrega['nombre']}}</td>
            <td>{{$entrega['precio']}}</td>
            <td>{{$entrega['cantidad']}}</td>
            <td>{{$entrega['total']}}</td>
        </tr>
        @php
        $total = $total + $entrega['total'];
        @endphp
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td>TOTAL</td>
            <td>{{number_format($total, 2, '.', ',')}}</td>
        </tr>
    </tfoot>
</table>