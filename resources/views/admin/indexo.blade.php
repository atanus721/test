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
                                {{ __('Tienda') }}
                            </span>
                            
                             <div class="float-center">
                            @if($errors->any())
							<h4>{{$errors->first()}}</h4>
							@endif
							</div>

                             <div class="float-right">
                             	@if (Auth::user()->id == 15)
								<a href="{{ route('administrador.index') }}" class="btn btn-info btn-sm float-right"  data-placement="left">
									{{ __('Administrador') }}
								</a>
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
                                            <td></td>
                                            
											<td></td>

											<td>
												@if ($cntdiferen == 0)
												<div class="btn btn-sm btn-success">
												@endif
												@if (($cntdiferen > 0) && ($cntdiferen <= 2 ))
												<div class="btn btn-sm btn-warning">
												@endif
												@if ($cntdiferen > 2)
												<div class="btn btn-sm btn-danger">
												@endif
												{{ $cntdiferen }}
												</div>
											</td>
											<td>
												@if (($tienda->updated_at->format('Y-m-d h')) == (date('Y-m-d h')))
													<p class="text-primary">{{ $tienda->updated_at }}</p>
												@else
													<p class="text-danger">{{ $tienda->updated_at  }}</p>
												@endif
											
											</td>

                                            <td>
                                                <form action="{{ route('tiendas.destroy') }}" method="POST">
                                                	@csrf
													
													<a class="btn btn-sm btn-primary " href="{{ route('tiendas.actualizar',$tienda->id) }}"><i class="fa fa-fw fa-eye"></i> Actualizar</a>
													<a class="btn btn-sm btn-secondary " href="{{ route('tiendas.cruceprecios',$tienda->id) }}"><i class="fa fa-fw fa-eye"></i> Dif</a>
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
										<?php
											$comparativos = array();
										?>											
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
		"columnDefs": [ {orderable: false, targets: [10]}, { targets: [0,1,2] } ]
	});
});
</script>
@endsection