<div>
    <div class="card card-primary mt-3">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">

                <span id="card_title">
                    Configuración de Turno {{$turno->nombre}}
                </span>

                <div class="float-right">
                    <a href="{{ route('turnos.index') }}" class="btn btn-primary btn-sm float-right"
                        data-placement="left">
                        <i class="fas fa-arrow-left"></i> {{ __('Volver') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h5>Agrega Items al turno</h5>
            <hr>
            <div class="row">
                <div class="col-12 col-md-3 mb-2">
                    <label for="">Franja</label>
                    <select class="form-control form-control-sm" id="franja">
                        <option value="">- Seleccione -</option>
                        @foreach ($franjas as $franja)
                        <option value="{{$franja->id}}">{{$franja->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-2 mb-2">
                    <label for=""> Presencial</label>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="presencial" checked
                                onclick="verifPresencial()">
                            <label class="custom-control-label" for="presencial"></label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <label for=""> Genera Reserva</label>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="genreserva"
                                onclick="verifGenReserva()">
                            <label class="custom-control-label" for="genreserva"></label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 mb-2">
                    <label for="">Reserva generada</label>
                    <select class="form-control form-control-sm" disabled id="franjareserva">
                        <option value="">- Seleccione -</option>
                        @foreach ($franjas as $franja)
                        <option value="{{$franja->id}}">{{$franja->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-2 mb-2">
                    <label for="">Adicionar</label>
                    <button class="btn btn-sm btn-success btn-block" onclick="save();"><i class="fas fa-arrow-down"></i>
                        Agregar</button>
                </div>
            </div>
            <hr>
            @if ($detalles->count() > 0)
            <div class="content">
                <h5>Items configurados</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="table-primary">
                                <th>NRO</th>
                                <th>FRANJA</th>
                                <th>PRESENCIAL</th>
                                <th>GENERA RESERVA</th>
                                <th>PRODUCTO RESERVADO</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=0;
                            @endphp
                            @foreach ($detalles as $detalle)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$detalle->franja->nombre}}</td>
                                <td>{{$detalle->presencial?'SI':'NO'}}</td>
                                <td>{{$detalle->generareserva?'SI':'NO'}}</td>
                                <td>{{$detalle->reservafranja?$detalle->franjareserva->nombre:"NO"}}</td>
                                <td>
                                    <button class="btn btn-sm btn-danger" title="Eliminar"
                                        wire:click='delete({{$detalle->id}})'><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@section('js')
<script>
    Livewire.on('success', msg =>{
        Swal.fire(
        'Excelente!',
        msg,
        'success'
        )
   });

   Livewire.on('error', msg =>{
        Swal.fire(
        'Atención',
        msg,
        'error'
        )
   });

    function verifPresencial(){
    if( $('#presencial').prop('checked') ) {
        $("#genreserva").prop('disabled', false);        
    }else{
        $( "#genreserva" ).prop( "checked", false );
        $("#genreserva").prop('disabled', true);
        $("#franjareserva").prop('disabled', true);
        $("#franjareserva").val("");
    }
}
function verifGenReserva(){
    if( $('#genreserva').prop('checked') ) {
        $("#franjareserva").prop('disabled', false);
    }else{
        $("#franjareserva").prop('disabled', true);
        $("#franjareserva").val("") ;
    }
}

function save(){
    var franja_id = $('#franja').val();
    var presencial = $('#presencial').prop('checked');
    var genreserva = $('#genreserva').prop('checked');
    var franjareserva = $('#franjareserva').val();
    
    if(franja_id!= ""){
            $("#franja").val("") ;
        $("#franjareserva").val("") ;
        $("#franjareserva").prop('disabled', true);
        $("#genreserva").prop('disabled', true);
        $("#presencial").prop('disabled', false);
        Livewire.emit('save',franja_id,presencial,genreserva,franjareserva);   
    }
    else{
        Swal.fire(
            "Atención",
            'Debe seleccionar una Franja',
            'error'
        );
    }
 
}
</script>
@endsection