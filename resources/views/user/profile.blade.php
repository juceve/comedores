@extends('adminlte::page')

@section('title', 'Mi Perfil')

@section('content_header')
<h1>Mi Perfil</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="bg-dark" align="center">
                                <th colspan="2">INFORMACIÓN PERSONAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <label>NOMBRE:</label>
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>CORREO:</label>
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>ROL SISTEMA:</label>
                                </td>
                                <td>
                                    {{ Auth::user()->roles->pluck('name')[0]}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-dark" align="center">
                            <th colspan="2">CAMBIAR CONTRASEÑA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form class="form-horizontal" method="POST" action="{{ route('changePasswordPost') }}">
                            @csrf
                            <tr>
                                <td>
                                    <label>ACTUAL:</label>
                                </td>
                                <td>
                                    <input id="current-password" type="password" class="form-control form-control-sm" placeholder="Contraseña actual"
                                        name="current-password" value="{{old('current-password')}}" required>

                                    @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>NUEVA:</label>
                                </td>
                                <td>
                                    <input id="new-password" type="password" class="form-control form-control-sm" name="new-password" value="{{old('new-password')}}" placeholder="Nueva contraseña"
                                        required>

                                    @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>CONFIRMA:</label>
                                </td>
                                <td>
                                    <input id="new-password-confirm" type="password" class="form-control form-control-sm" value="{{old('new-password_confirmation')}}" placeholder="Confirmar contraseña"
                                        name="new-password_confirmation" required>
                                    @error('password_confirmation')
                                    <small class="text-danger">
                                        {{$message}}
                                    </small>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i>
                                        Guardar Cambios</button>
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
{{-- <div class="row">

    <div class="col-md-10 offset-2">
        <div class="panel panel-default">
            <h2>Change password</h2>

            <div class="panel-body">
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                @if($errors)
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
                @endif
                <form class="form-horizontal" method="POST" action="{{ route('changePasswordPost') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="col-md-4 control-label">Current Password</label>

                        <div class="col-md-6">
                            <input id="current-password" type="password" class="form-control" name="current-password"
                                required>

                            @if ($errors->has('current-password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('current-password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="col-md-4 control-label">New Password</label>

                        <div class="col-md-6">
                            <input id="new-password" type="password" class="form-control" name="new-password" required>

                            @if ($errors->has('new-password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('new-password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                        <div class="col-md-6">
                            <input id="new-password-confirm" type="password" class="form-control"
                                name="new-password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Change Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div> --}}
@stop

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
@stop