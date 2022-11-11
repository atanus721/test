@extends('layouts.app')

@section('template_title')
    Preciostienda
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Preciostienda') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('preciostiendas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Id Sap</th>
										<th>Sku</th>
										<th>Precioa</th>
										<th>Preciob</th>
										<th>Precioc</th>
										<th>Preciod</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($preciostiendas as $preciostienda)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $preciostienda->id_sap }}</td>
											<td>{{ $preciostienda->sku }}</td>
											<td>{{ $preciostienda->precioa }}</td>
											<td>{{ $preciostienda->preciob }}</td>
											<td>{{ $preciostienda->precioc }}</td>
											<td>{{ $preciostienda->preciod }}</td>

                                            <td>
                                                <form action="{{ route('preciostiendas.destroy',$preciostienda->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('preciostiendas.show',$preciostienda->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('preciostiendas.edit',$preciostienda->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $preciostiendas->links() !!}
            </div>
        </div>
    </div>
@endsection
