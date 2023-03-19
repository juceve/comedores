@extends('layouts.app')

@section('template_title')
    Entregasmanuale
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Entregasmanuale') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('entregasmanuales.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Entrega Id</th>
										<th>User Id</th>
										<th>Ip</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($entregasmanuales as $entregasmanuale)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $entregasmanuale->entrega_id }}</td>
											<td>{{ $entregasmanuale->user_id }}</td>
											<td>{{ $entregasmanuale->ip }}</td>

                                            <td>
                                                <form action="{{ route('entregasmanuales.destroy',$entregasmanuale->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('entregasmanuales.show',$entregasmanuale->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('entregasmanuales.edit',$entregasmanuale->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $entregasmanuales->links() !!}
            </div>
        </div>
    </div>
@endsection
