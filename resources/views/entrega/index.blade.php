@extends('adminlte::page')

@section('title')
    Entregas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary mt-3">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                LISTADO DE ENTREGAS
                            </span>

                             <div class="float-right">
                                <a href="{{ route('entregas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>No</th>
                                        
										<th>Fecha</th>
										<th>Cliente Id</th>
										<th>Franja Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entregas as $entrega)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $entrega->fecha }}</td>
											<td>{{ $entrega->cliente_id }}</td>
											<td>{{ $entrega->franja_id }}</td>

                                            <td>
                                                <form action="{{ route('entregas.destroy',$entrega->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('entregas.show',$entrega->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('entregas.edit',$entrega->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $entregas->links() !!}
            </div>
        </div>
    </div>
@endsection
