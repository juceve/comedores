<div>
    @if ($alimento == "")
    <h1 class="text-danger">FUERA DE HORARIO</h1>
    @else
    <h1 class="text-success">{{$alimento}}</h1>
    @endif
    <div class="content mt-5">
        <h3 class="text-secondary">INGRESE SU CÉDULA DE IDENTIDAD</h3>
        <div class="row">
            <div class="col-12 col-lg-3"></div>
            <div class="col-12 col-lg-6">
                <div class="input-group mb-3 py-4">
                    <input type="search" id="cedula" class="form-control form-control-lg fs-2"
                        placeholder="Cédula de Identidad" aria-label="Cédula de Identidad"
                        aria-describedby="button-addon2" wire:model="cedula" wire:keydown.enter="busqueda">
                    <button class="btn btn-success fs-4" type="button" id="button-addon2" wire:click='busqueda'><i
                            class="bi bi-search"></i>
                        Buscar</button>
                </div>
            </div>
            <div class="col-12 col-lg-3"></div>
        </div>
    </div>
</div>
@section('js')
<script>
    document.getElementById("cedula").focus();

   Livewire.on('inicioRegistro', cadena=>{
    var resultado = cadena.split('|');
    
    Swal.fire({
    title: resultado[1],
    text: "DESEA RECOGER: "+resultado[2],
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, recoger!',
    cancelButtonText: 'No, cancelar',
    }).then((result) => {
    if (result.isConfirmed) {
        Livewire.emit('registrarEntrega');
    }
    })
   });

   Livewire.on('success', msg =>{
        Swal.fire(
        'Entregado!',
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
</script>
@endsection