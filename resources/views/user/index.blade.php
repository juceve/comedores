@extends('adminlte::page')

@section('title')
USUARIOS
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            Usuarios del Sistema
                        </span>

                        <div class="float-right">
                            @can('users.create')
                            <a href="{{ route('users.create') }}" class="btn btn-secondary btn-sm float-right"
                                data-placement="left">
                                <i class="fas fa-plus"></i> Nuevo
                            </a>
                            @endcan

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
                                    <th>Email</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=0;
                                @endphp
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>

                                    <td>
                                        @can('users.edit')
                                        <form class="form-horizontal reset" method="POST"
                                            action="{{ route('resetPassword',$user->id) }}">
                                            @csrf
                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('users.edit',$user->id) }}"><i
                                                    class="fa fa-fw fa-edit"></i> Editar Rol </a>

                                            <button type="submit" class="btn btn-sm btn-warning">
                                                <i class="fas fa-key"></i> Reset Password
                                            </button>
                                        </form>
                                        @endcan
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
  '{{ $message }}',
  'success'
)
</script>
@endif
@if ($message = Session::get('error'))
<script>
    Swal.fire(
  'Atención!',
  '{{ $message }}',
  'error'
)
</script>
@endif

<script>
    $(document).ready(function () {
            $('.dataTable').DataTable();
        });
        
        $('.reset').submit(function (e) { 
            e.preventDefault();
            Swal.fire({
                title: 'Restablecer Password',
                text: "Está seguro de realizar esta operación?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No, cancelar',
                confirmButtonText: 'Si, continuar!'
                }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
                })            
        });
</script>
@endsection