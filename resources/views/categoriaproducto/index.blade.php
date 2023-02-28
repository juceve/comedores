@extends('adminlte::page')

@section('title')
Categoria de productos
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card mt-3">
                <div class="card-header bg-success">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Categoria de productos') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('categoriaproductos.create') }}"
                                class="btn btn-success btn-sm float-right" data-placement="left">
                                <i class="fas fa-plus"></i> Nuevo
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTable">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Nombre</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=0;
                                @endphp
                                @foreach ($categoriaproductos as $categoriaproducto)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $categoriaproducto->nombre }}</td>

                                    <td>
                                        <form action="{{ route('categoriaproductos.destroy',$categoriaproducto->id) }}"
                                            method="POST">
                                            <a class="btn btn-sm btn-primary "
                                                href="{{ route('categoriaproductos.show',$categoriaproducto->id) }}"><i
                                                    class="fa fa-fw fa-eye"></i> Show</a>
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('categoriaproductos.edit',$categoriaproducto->id) }}"><i
                                                    class="fa fa-fw fa-edit"></i> Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-fw fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@if ($message = Session::get('success'))
<script>
    Swal.fire(
        'Excelente!',
        'Se registró correctamente',
        'success'
    )
</script>
@endif
<script>
    $(document).ready(function() {
        var hoy = new Date();
    $('.dataTable').DataTable( {
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        pageLength : 5,
        lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']],
        
    } );
} );
</script>
@endsection