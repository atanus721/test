@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('datatables\datatables.min.css') }}">
<!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"-->
<!--link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="style"-->
@endsection
<!-- Template -->
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
                                {{ __('Tienda') }} : MÓDULO DE COMPARACIÓN DE PRECIOS
                            </span>
                            
                             <div class="float-center">
                            @if($errors->any())
							<h4>{{$errors->first()}}</h4>
							@endif
							</div>

                             <div class="float-right">
                             	@if (Auth::user()->id == 15)
								<a href="{{ route('administrador.show', 0) }}" class="btn btn-info btn-sm float-right"  data-placement="left">
									{{ __('Procesar precios TIENDAS') }}
								</a>
                                <a href="{{ route('administrador.dam', 0) }}" class="btn btn-secondary btn-sm float-right"  data-placement="left">
									{{ __('Procesar precios DAM') }}
								</a>
                                <a href="{{ route('administrador.diferencias', 0) }}" class="btn btn-light btn-sm float-right"  data-placement="left">
									{{ __('Procesar DIFERENCIAS') }}
								</a>
                                <a href="{{ route('tiendas.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('<< Monitor Tienda') }}
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
							
                            <table id="tienda" class="table table-striped table-bordered">
                                <thead class="thead">
                                    <tr>
                                        <th style="padding-left: 30px;">No</th>
                                        
										<th style="padding-left: 30px;">Nombre</th>
										<th style="padding-left: 30px;">DIF</th>
										<th style="padding-left: 30px;">ULTIMA ACTUALIZACION</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tiendas as $tienda)
                                        <tr>
                                            <td>{{ $tienda->id_sap }}</td>
                                            
											<td>{{ $tienda->nombre }}</td>

											<td>
												@if ($tienda->diftotal == 0)
												<div class="btn btn-sm btn-success">
													0
												</div>
												@else
												<div class="btn btn-sm btn-warning">
													{{ $tienda->diftotal }}
												</div>
												@endif
                                            </td>
											<td>                                            
												@if (($tienda->updated_at->format('Y-m-d')) == (date('Y-m-d')))
													<p class="text-primary">{{ $tienda->created_at }}</p>
												@else
													<p class="text-danger">{{ $tienda->created_at }}</p>
												@endif
                                            </td>
                                            <td>
                                                <form action="" method="POST">
                                                	@csrf
													<a class="btn btn-sm btn-success " href="{{ route('administrador.tiendasid', $tienda->id) }}"><i class="fa fa-fw fa-eye"></i> Procesar Tienda</a>
													<a class="btn btn-sm btn-primary " href="{{ route('administrador.tiendasdamid', $tienda->id) }}"><i class="fa fa-fw fa-eye"></i> Procesr DAM</a>
													<a class="btn btn-sm btn-secondary " href="{{ route('administrador.diferenciasid', $tienda->id) }}"><i class="fa fa-fw fa-eye"></i> Dife</a>
                                                	
                                                	@if (Auth::user()->id == 15)
                                                    @csrf
                                                    @method('DELETE')
                                                    <!--button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Drop tienda </button-->
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
            </div>
        </div>
    </div>
@endsection

@section('js')
<!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function () {
    $('#tienda').DataTable({
		"language": {
			"url": 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
		},
		"lengthMenu": [[60, 120, 180, -1], [60, 120, 180, 'Todos']],
		"columnDefs": [ {orderable: false, targets: [4]}, { targets: [0,1] } ]
	});
});
</script>
@endsection