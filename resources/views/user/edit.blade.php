@extends('adminlte::page')

@section('title')
EDITAR USUARIO
@endsection

@section('content')
<section class="content container-fluid">
    <div class="">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-secondary mt-3">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            Editar Usuario
                        </span>

                        <div class="float-right">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm float-right"
                                data-placement="left">
                                <i class="fas fa-arrow-left"></i> Volver
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <label for="">Nombre usuario</label>
                    <input type="text" class="form-control mb-2" readonly value="{{$user->name}}">
                    <hr>
                    <h2 class="h5">Listado de Roles</h2>
                    {!! Form::model($user, ['route' => ['users.update',$user], 'method' => 'put']) !!}
                        @foreach ($roles as $role)
                            <div>
                                <label for="">
                                    {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                                    {{$role->name}}
                                </label>
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary">Asignar Rol</button>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
    @if (session('success'))
        <script>
            Swal.fire("Excelente!", '{{session('success')}}','success');
        </script>
    @endif
@endsection