@extends('layouts.app')

@section('template_title')
    Traspaso
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Traspaso') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('traspasos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Id Tienda Destino</th>
										<th>Id Tienda Origen</th>
										<th>Fecha</th>
										<th>Folio</th>
										<th>Archivo</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($traspasos as $traspaso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $traspaso->id_tienda_destino }}</td>
											<td>{{ $traspaso->id_tienda_origen }}</td>
											<td>{{ $traspaso->fecha }}</td>
											<td>{{ $traspaso->folio }}</td>
											<td>{{ $traspaso->archivo }}</td>

                                            <td>
                                                <form action="{{ route('traspasos.destroy',$traspaso->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('traspasos.show',$traspaso->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('traspasos.edit',$traspaso->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $traspasos->links() !!}
            </div>
        </div>
    </div>
@endsection
