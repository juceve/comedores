@extends('adminlte::page')

@section('title')
TURNOS
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary mt-3">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Turnos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('turnos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  <i class="fas fa-plus"></i> Nuevo
                                </a>
                              </div>
                        </div>
                    </div>
                    

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Nombre</th>
										<th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($turnos as $turno)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $turno->nombre }}</td>
											<td>
                                                @if ($turno->estado)
                                                <span style="width: 60px;" class="badge rounded-pill bg-success">Activo</span>
                                                @else
                                                <span style="width: 60px;"
                                                    class="badge rounded-pill bg-secondary">Inactivo</span>
                                                @endif
                                            </td>

                                            <td>
                                                <form action="{{ route('turnos.destroy',$turno->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-warning " href="{{ route('turnos.config',$turno->id) }}"><i class="fas fa-sliders-h"></i> Configurar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('turnos.edit',$turno->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $turnos->links() !!}
            </div>
        </div>
    </div>
@endsection
@section('js')
@if ($message = Session::get('success'))
<script>
    Swal.fire(
        'Excelente!',
        '{{$message}}',
        'success',
    )
</script>
@endif
@endsection