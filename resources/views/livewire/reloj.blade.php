<div class="text-right">
    <small class="">Hora del Servidor:</small>
    
    <span>{{$relojServer}}</span>
</div>
<script>
    setInterval('reloj()',1000);
    function reloj(){
        Livewire.emit('reloj');
    }
</script>
