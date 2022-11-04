@extends('layouts.app')

@section('template_title')
    Tienda
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tienda') }}
                            </span>
                            
                             <div class="float-center">
                            @if($errors->any())
							<h4>{{$errors->first()}}</h4>
							@endif
							</div>

                             <div class="float-right">
                             	@if (Auth::user()->id == 1)
                                <a href="{{ route('tiendas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Nueva tienda') }}
                                </a>
                                @endif
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
                                        <th>@sortablelink('id_sap', 'No')</th>
                                        
										<th>@sortablelink('nombre', 'Nombre')</th>
										<th>$</th>
										<th>TE</th>
										<th>TS</th>
										<th>EME</th>
										<th>EMAT</th>
										<th>DEV</th>
										<th>ULTIMA ACTUALIZACION</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tiendas as $tienda)
                                        <tr>
                                            <td>{{ $tienda->id_sap }}</td>
                                            
											<td>{{ $tienda->nombre }}</td>
											<td>
												@if ($tienda->precios()->count() == 0)
												<div class="btn btn-sm btn-success">
												@endif
												@if ($tienda->precios()->count() > 0)
												<div class="btn btn-sm btn-danger">
												@endif
												{{ $tienda->precios()->count() }}
												</div>
												
											</td>
											<td>
												@if ($tienda->traspasosdestino()->count() == 0)
												<div class="btn btn-sm btn-success">
												@endif
												@if (($tienda->traspasosdestino()->count() > 0) && ($tienda->traspasosdestino()->count() <= 2 ))
												<div class="btn btn-sm btn-warning">
												@endif
												@if ($tienda->traspasosdestino()->count() > 2)
												<div class="btn btn-sm btn-danger">
												@endif
												{{ $tienda->traspasosdestino()->count() }}
												</div>
											</td>
											<td>
												@if ($tienda->traspasosorigen()->count() == 0)
												<div class="btn btn-sm btn-success">
												@endif
												@if (($tienda->traspasosorigen()->count() > 0) && ($tienda->traspasosorigen()->count() <= 2 ))
												<div class="btn btn-sm btn-warning">
												@endif
												@if ($tienda->traspasosorigen()->count() > 2)
												<div class="btn btn-sm btn-danger">
												@endif
												{{ $tienda->traspasosorigen()->count() }}
												</div>
											</td>
											<td>
												@if ($tienda->embarquemercancias()->count() == 0)
												<div class="btn btn-sm btn-success">
												@endif
												@if (($tienda->embarquemercancias()->count() > 0) && ($tienda->embarquemercancias()->count() <= 2 ))
												<div class="btn btn-sm btn-warning">
												@endif
												@if ($tienda->embarquemercancias()->count() > 2)
												<div class="btn btn-sm btn-danger">
												@endif
												{{ $tienda->embarquemercancias()->count() }}
												</div>
											</td>
											<td>
												@if ($tienda->embarquemateriales()->count() == 0)
												<div class="btn btn-sm btn-success">
												@endif
												@if (($tienda->embarquemateriales()->count() > 0) && ($tienda->embarquemateriales()->count() <= 2 ))
												<div class="btn btn-sm btn-warning">
												@endif
												@if ($tienda->embarquemateriales()->count() > 2)
												<div class="btn btn-sm btn-danger">
												@endif
												{{ $tienda->embarquemateriales()->count() }}
												</div>
											</td>
											<td>
												@if ($tienda->devoluciones()->count() == 0)
												<div class="btn btn-sm btn-success">
												@endif
												@if (($tienda->devoluciones()->count() > 0) && ($tienda->devoluciones()->count() <= 2 ))
												<div class="btn btn-sm btn-warning">
												@endif
												@if ($tienda->devoluciones()->count() > 2)
												<div class="btn btn-sm btn-danger">
												@endif
												{{ $tienda->devoluciones()->count() }}
												</div>
											</td>
											<td>{{ $tienda->updated_at }}</td>

                                            <td>
                                                <form action="{{ route('tiendas.destroy',$tienda->id) }}" method="POST">
                                                	<a class="btn btn-sm btn-primary " href="{{ route('tiendas.actualizar',$tienda->id) }}"><i class="fa fa-fw fa-eye"></i> Actualizar</a>
                                                	<a class="btn btn-sm btn-success " href="{{ route('tiendas.show',$tienda->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                	@if (Auth::user()->id == 1)
                                                    <a class="btn btn-sm btn-warning" href="{{ route('tiendas.edit',$tienda->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $tiendas->links() !!}
            </div>
        </div>
    </div>
@endsection
