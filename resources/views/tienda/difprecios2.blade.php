@extends('layouts.app')
@section('css')
	<link rel="stylesheet" href="{{ asset('datatables\datatables.min.css') }}">
	<!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"-->
	<!--link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="style"-->

    <!-- searchPanes -->
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.0.1/css/searchPanes.dataTables.min.css">
    <!-- select -->
    <link href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
@endsection
@section('template_title')
    {{ $tienda->name ?? 'Show Tienda' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Tienda: <strong>{{ $tienda->id_sap}} {{ $tienda->nombre }}</strong> </span>
                        </div>
                        
                    </div>

                    <div class="card-body">
                        
                        @if (Auth::user()->id == 1)
                        <div class="form-group">
                        	<div class="row h4">Credenciales FTP</div>
                        	<div class="row">
                        		<div class="col-1"><strong>Usuario</strong></div>
                            	<div class="col-2 align-left">{{ $tienda->usuarioftp }}</div>
                        	</div>
                        	<div class="row">
                        		<div class="col-1"><strong>Contrase&ntilde;a:</strong></div>
                            	<div class="col-2">{{ $tienda->passwdftp }}</div>
                        	</div>
                        </div>
                        @Endif
                        <div class="row">
                        	<span class="h4 text-center"><br />DIFERENCIA DE PRECIOS</span>
                        </div>
                        <br />
						<div class="card">
                        	<div class="card-header"><strong>HERRAMIENTAS</strong></div>
							@if (count($compara) > 0)
                            <div class="table-responsive">
                                <table id="tienda" class="table table-striped table-hover">
                                    <thead class="thead">
                                    	<tr>
                                    		<th style="padding-left: 30px;">SKU</th>
                                    		<th>MRTienda vs DAM - A</th>
                                    		<th>MRTienda vs DAM - B</th>
                                    		<th>MRTienda vs DAM - C</th>
                                    		<th>MRTienda vs DAM - D</th>
											<th style="padding-left: 30px;">FECHA</th>
                                    	</tr>
                                    </thead>
                                    <tbody>
                                    	@foreach ($compara as $comp)
                                    	<tr>
                                    		<td>
												{{ $comp->sku }}
											</td>
											<td>
												@if (($comp->mrtienda_a) == ($comp->dam_a))
													<p class="text-primary">{{ $comp->mrtienda_a . '-' . $comp->dam_a . ' Dif ' . $comp->dif_a}}</p>
												@else
													<p class="text-danger">{{ $comp->mrtienda_a . '-' . $comp->dam_a . ' Dif ' . $comp->dif_a}}</p>
												@endif
											</td>
											<td>
												@if (($comp->mrtienda_b) == ($comp->dam_b))
												<p class="text-primary">{{ $comp->mrtienda_b . '-' . $comp->dam_b . ' Dif ' . $comp->dif_b}}</p>
											@else
												<p class="text-danger">{{ $comp->mrtienda_b . '-' . $comp->dam_b . ' Dif ' . $comp->dif_b}}</p>
											@endif
											</td>
											<td>
												@if (($comp->mrtienda_c) == ($comp->dam_c))
													<p class="text-primary">{{ $comp->mrtienda_c . '-' . $comp->dam_c . ' Dif ' . $comp->dif_c}}</p>
												@else
													<p class="text-danger">{{ $comp->mrtienda_c . '-' . $comp->dam_c . ' Dif ' . $comp->dif_c}}</p>
												@endif
											</td>
											<td>
												@if (($comp->mrtienda_d) == ($comp->dam_d))
													<p class="text-primary">{{ $comp->mrtienda_d . '-' . $comp->dam_d . ' Dif ' . $comp->dif_d}}</p>
												@else
													<p class="text-danger">{{ $comp->mrtienda_d . '-' . $comp->dam_d . ' Dif ' . $comp->dif_d}}</p>
												@endif
											</td>
											<td>{{ $comp->fecha_dam }}</td>
                                    	</tr>
                                    	@endforeach
                                    </tbody>
                                </table>
                            </div>
                            @Else
                            <div class="row">
                        		<span class="h5 text-center text-success">Sin diferencias.</span>
                        	</div>
                            @Endif
                        </div>
						                        
                    </div>
                    <div class="card-footer">
                    	<div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tiendas.index') }}"> Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
<!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<!-- searchPanes   -->
<script src="https://cdn.datatables.net/searchpanes/1.0.1/js/dataTables.searchPanes.min.js"></script>
<!-- select -->
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script> 

<script>
$(document).ready(function () {
    $('#tienda').DataTable({
		"language": {
			"url": 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
		},
		searchPanes:{
			cascadePanes:true,
			dtOpts:{
				dom:'tp',
				paging:'true',
				searching:false
			}
		},
		dom:'Pfrtip',
		columnDefs:[{
			searchPanes:{
				show:false
			},
			targets:[5]
		}],
		"lengthMenu": [[10, 20, 30, -1], [10, 20, 30, 'Todos']],
		"columnDefs": [ {orderable: false, targets: [1,2,3,4]}, { targets: [0,5] } ]
	});
});
</script>
@endsection