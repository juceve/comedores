<table class="table table-bordered table-sm fuentesm" style="width: 100%">
    <thead>
        <tr class="text-center" style="background-color: rgb(117, 117, 117);">
            <td><strong><font color="white"> EMPRESA</font></strong></td>
            <td><strong><font color="white"> CLIENTE/PRODUCTO</font></strong></td>
            <td><strong><font color="white"> CANTIDAD</font></strong></td>
            <td><strong><font color="white"> IMPORTE Bs.</font></strong></td>
        </tr>
    </thead>

    @php
    $totalImporte = 0;
    $b=0;
    @endphp
    @foreach ($contenedor as $item)
    @if ($b > 0)
    <tr >
        <td></td>
        <td align="right" style="background-color: rgb(228, 227, 227);"><strong>TOTAL</strong></td>
        <td align="right" style="background-color: rgb(228, 227, 227);"><strong>{{$totalclientecantidad}}</strong></td>
        <td align="right" style="background-color: rgb(228, 227, 227);"><strong>{{number_format($totalclienteimporte, 2, '.', ',');}}</strong></td>
    </tr>
    <tr><td colspan="4"> </td></tr>
    @endif
    <tr class="table-secondary" style="background-color: rgb(228, 227, 227);">
        <td><b> {{$item[0]}}</b></td>
        <td><b></b></td>
        <td align="right"><b> {{$item[1]}}</b></td>
        <td align="right"><b> {{number_format($item[3], 2, '.', ',');}}</b></td>
    </tr>
    <tr><td colspan="4"> </td></tr>
    @php
    $totalImporte = $totalImporte + $item[3];
    $datas = $item[2];

    @endphp

    @if (count($datas))
        @php
        $cliente = "";
        $b2 = 0;
        @endphp
        @foreach ($datas as $data)
            @if ($cliente != $data[0])                                        
                @if ($b2 > 0)
                    <tr >
                        <td></td>
                        <td align="right" style="background-color: rgb(228, 227, 227);"><strong>TOTAL</strong></td>
                        <td align="right" style="background-color: rgb(228, 227, 227);"><strong>{{$totalclientecantidad}}</strong></td>
                        <td align="right" style="background-color: rgb(228, 227, 227);"><strong>{{number_format($totalclienteimporte, 2, '.', ',');}}</strong></td>
                    </tr>
                    <tr><td colspan="4"> </td></tr>
                @endif
                @php
                $cliente = $data[0];
                $totalclientecantidad = 0;
                $totalclienteimporte = 0;
                $b2++;
                @endphp
                <tr >
                    <td></td>
                    <td style="background-color: rgb(228, 227, 227);"><strong>{{$data[0]}}</strong></td>
                    <td style="background-color: rgb(228, 227, 227);"></td>
                    <td style="background-color: rgb(228, 227, 227);"></td>
                </tr>
            @endif
        <tr>
            <td></td>
            <td>
                <div class="row">
                    <div class="col-2 col-md-6"></div>
                    <div class="col-10 col-md-6">
                        {{$data[1]}}
                    </div>
                </div>                                        
            </td>
            <td align="right">{{$data[2]}}</td>
            <td align="right">{{number_format($data[3], 2, '.', ',');}}</td>
        </tr>
        @php
            $totalclientecantidad = $totalclientecantidad + $data[2];
            $totalclienteimporte = $totalclienteimporte + $data[3];
        @endphp
        @endforeach
    @endif
        @php
            $b++;
        @endphp
    @endforeach
    <tr >
        <td></td>
        <td align="right" style="background-color: rgb(228, 227, 227);"><strong>TOTAL</strong></td>
        <td align="right" style="background-color: rgb(228, 227, 227);"><strong>{{$totalclientecantidad}}</strong></td>
        <td align="right" style="background-color: rgb(228, 227, 227);"><strong>{{number_format($totalclienteimporte, 2, '.', ',');}}</strong></td>
    </tr>
    <tfoot>
        <tr>
            <td colspan="2"></td>
            <td style="background-color: rgb(117, 117, 117);" align="right"><b><font color="white">IMPORTE TOTAL</font></b></td>
            <td style="background-color: rgb(117, 117, 117);" align="right"><b><font color="white">{{number_format($totalImporte, 2, '.',
                    ',');}}</font></b>
            </td>
        </tr>
    </tfoot>


</table>