@extends('adminlte::page')

@section('title')
Franjas
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary mt-3">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            LISTADO DE FRANJAS HORARIAS
                        </span>

                        <div class="float-right">
                            <a href="{{ route('franjas.create') }}" class="btn btn-primary btn-sm float-right"
                                data-placement="left">
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
                                    <th>Hora inicio</th>
                                    <th>Hora final</th>
                                    <th>Precio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($franjas as $franja)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $franja->nombre }}</td>
                                    <td>{{ $franja->horainicio }}</td>
                                    <td>{{ $franja->horafinal }}</td>
                                    <td>{{ $franja->precio }}</td>
                                    <td>
                                        <form action="{{ route('franjas.destroy',$franja->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary "
                                                href="{{ route('franjas.show',$franja->id) }}"><i
                                                    class="fa fa-fw fa-eye"></i> Ver</a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('franjas.edit',$franja->id) }}"><i
                                                    class="fa fa-fw fa-edit"></i> Editar</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-fw fa-trash"></i> Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $franjas->links() !!}
        </div>
    </div>
</div>
@endsection
@section('js')
@if ($message = Session::get('success'))
<script>
    Swal.fire(
  'Excelente!',
  '{{ $message }}',
  'success'
)
</script>
@endif
@endsection