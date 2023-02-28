@extends('layouts.app')

@section('template_title')
    Inventario
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Inventario') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('inventarios.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
										<th>Kiosko Id</th>
										<th>User Id</th>
										<th>Estado</th>
										<th>Cierre</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventarios as $inventario)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $inventario->fecha }}</td>
											<td>{{ $inventario->kiosko_id }}</td>
											<td>{{ $inventario->user_id }}</td>
											<td>{{ $inventario->estado }}</td>
											<td>{{ $inventario->cierre }}</td>

                                            <td>
                                                <form action="{{ route('inventarios.destroy',$inventario->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('inventarios.show',$inventario->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('inventarios.edit',$inventario->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $inventarios->links() !!}
            </div>
        </div>
    </div>
@endsection
