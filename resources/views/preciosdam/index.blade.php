@extends('layouts.app')

@section('template_title')
    Preciosdam
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Preciosdam') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('preciosdams.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Fecha</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($preciosdams as $preciosdam)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $preciosdam->id_sap }}</td>
											<td>{{ $preciosdam->sku }}</td>
											<td>{{ $preciosdam->precioa }}</td>
											<td>{{ $preciosdam->preciob }}</td>
											<td>{{ $preciosdam->precioc }}</td>
											<td>{{ $preciosdam->preciod }}</td>
											<td>{{ $preciosdam->fecha }}</td>

                                            <td>
                                                <form action="{{ route('preciosdams.destroy',$preciosdam->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('preciosdams.show',$preciosdam->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('preciosdams.edit',$preciosdam->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $preciosdams->links() !!}
            </div>
        </div>
    </div>
@endsection
