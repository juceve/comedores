@extends('adminlte::page')

@section('title')
MENSUALIDADES
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-info mt-3">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Mensualidades') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('mensualidades.create') }}" class="btn btn-info btn-sm float-right"  data-placement="left">
                                  <i class="fas fa-plus"></i> Nuevo
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>
                                        
										<th>FECHA</th>
										<th>MES-AÑO</th>
										<th>IMPORTE</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mensualidades as $mensualidade)
                                        <tr>
                                            <td>{{ $mensualidade->id }}</td>
                                            
											<td>{{ $mensualidade->fecha }}</td>
											<td>{{ $mensualidade->feccontrol }}</td>
											<td>{{ $mensualidade->importe }}</td>

                                            <td>
                                                <form action="{{ route('mensualidades.destroy',$mensualidade->id) }}" method="POST">
                                                    
                                                    <a class="btn btn-sm btn-success" href="{{ route('mensualidades.edit',$mensualidade->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $mensualidades->links() !!}
            </div>
        </div>
    </div>
@endsection
