@extends('layouts.app')

@section('template_title')
    Invdetalle
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Invdetalle') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('invdetalles.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Tipo</th>
										<th>Inventario Id</th>
										<th>Producto Id</th>
										<th>Cantidad</th>
										<th>Subtotal</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invdetalles as $invdetalle)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $invdetalle->tipo }}</td>
											<td>{{ $invdetalle->inventario_id }}</td>
											<td>{{ $invdetalle->producto_id }}</td>
											<td>{{ $invdetalle->cantidad }}</td>
											<td>{{ $invdetalle->subtotal }}</td>

                                            <td>
                                                <form action="{{ route('invdetalles.destroy',$invdetalle->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('invdetalles.show',$invdetalle->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('invdetalles.edit',$invdetalle->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $invdetalles->links() !!}
            </div>
        </div>
    </div>
@endsection
