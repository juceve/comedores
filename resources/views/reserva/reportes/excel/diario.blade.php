<table class="table table-bordered" style="width: 100%;">
    <tr>
        <td colspan="4" align="center"><b>REPORTE DE APROBACIONES</b></td>        
    </tr>
    <tr>
        <td colspan="4" align="center">Fecha {{$fecha}}</td>
    </tr>
    <thead>
        
        <tr style="background-color: #f0ecec;">
            <td align="center"><b>NRO</b></td>
            <td align="center"><b>CLIENTE</b></td>
            <td align="center"><b>PRODUCTO</b></td>            
            <td align="center"><b>APROBADO POR</b></td>                    
        </tr>
    </thead>
    <tbody>
        @php
        $i=0;
        $total = 0;
        @endphp
        @foreach ($contenedor as $item)
        <tr>
            <td align="center">{{++$i}}</td>
            <td>{{$item['cliente']}}</td>
            <td align="center">{{$item['franja']}}</td>
            
            <td align="center">{{$item['user']}}</td>
        </tr>
        @endforeach
    </tbody>            
</table>