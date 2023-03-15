<table class="table table-bordered" style="width: 100%;">
    <tr>
        <td colspan="4" align="center">
            REPORTE DE PRODUCTOS ENTREGADOS POR EMPRESA
        </td>
    </tr>
    <tr>
        <td colspan="4" align="center">
            Del {{$fechai}} al {{$fechaf}}
        </td>
    </tr>
    <thead>
        <tr style="background-color: #575757">
            <td align="center"><b>
                    <font color='#FFF'> EMPRESA</font>
                </b></td>
            <td align="center"><b>
                    <font color='#FFF'> PRODUCTO</font>
                </b></td>
            <td align="center" style="width: 150px"><b>
                    <font color='#FFF'> CANTIDAD</font>
                </b></td>
            <td align="center" style="width: 150px"><b>
                    <font color='#FFF'> IMPORTE Bs.</font>
                </b></td>
        </tr>
    </thead>
    <tbody>
        @if (!is_null($contenedor))
        @php
        $totalImporte = 0;
        @endphp
        @foreach ($contenedor as $item)
        <tr style="background-color: #f0ecec;">
            <td colspan="2"><b> {{$item[0]}}</b></td>
            <td align="right"><b> {{$item[1]}}</b></td>
            <td align="right"><b> {{number_format($item[3], 2, '.',',');}}</b></td>
        </tr>
        @php
        $totalImporte = $totalImporte + $item[3];
        @endphp
        @php
        $datas = $item[2];
        @endphp
        @foreach ($datas as $data)
        <tr>
            <td></td>
            <td>{{$data[0]}}</td>
            <td align="right">{{$data[1]}}</td>
            <td align="right">{{number_format($data[2], 2, '.',',');}}</td>
        </tr>
        @endforeach
        @endforeach
        @endif



    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"></td>
            <td align="right">
                <font color="#fff"> <b>IMPORTE TOTAL</b></font>
            </td>
            <td align="right">
                <b>{{number_format($totalImporte, 2, '.',',');}}</b>
            </td>
        </tr>
    </tfoot>
</table>