@extends('layouts.app')

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
                        	<span class="h4 text-center"><br />DETALLE DE PENDIENTES</span>
                        </div>
                        <div class="card">
                        	<div class="card-header"><strong>PRECIOS ( $ )</strong></div>
                        	@if ($tienda->precios()->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                    	<tr>
                                    		<th>FECHA DE PRECIO</th>
                                    		<th>ARCHIVO DE APLICACI&Oacute;N</th>
                                    		<th>FECHA DE DETECCI&Oacute;N</th>
                                    	</tr>
                                    </thead>
                                    <tbody>
                                    	@foreach ($tienda->precios()->get() as $precio)
                                    	<tr>
                                    		<td>{{ $precio->fecha }}</td>
                                    		<td>{{ $precio->archivo }}</td>
                                    		<td>{{ $precio->created_at }}</td>
                                    	</tr>
                                    	@endforeach
                                    </tbody>
                                </table>
                            </div>
                            @Else
                            <div class="row">
                        		<span class="h5 text-center text-success">Sin pendientes.</span>
                        	</div>
                            @Endif
                        </div>
                        <br />
                        <div class="card">
                        	<div class="card-header"><strong>TRASPASOS ENTRANTES ( TE )</strong></div>
                        	@if ($tienda->traspasosdestino()->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                    	<tr>
                                    		<th>TIENDA ORIGEN</th>
                                    		<th>FECHA</th>
                                    		<th>FOLIO</th>
                                    		<th>ARCHIVO DE APLICACI&Oacute;N</th>
                                    		<th>FECHA DE DETECCI&Oacute;N</th>
                                    	</tr>
                                    </thead>
                                    <tbody>
                                    	@foreach ($tienda->traspasosdestino()->get() as $traspasoentrante)
                                    	<tr>
                                    		<td>{{ $traspasoentrante->tiendaorigen->nombre }}</td>
                                    		<td>{{ $traspasoentrante->fecha }}</td>
                                    		<td>{{ $traspasoentrante->folio }}</td>
                                    		<td>{{ $traspasoentrante->archivo }}</td>
                                    		<td>{{ $traspasoentrante->created_at }}</td>
                                    	</tr>
                                    	@endforeach
                                    </tbody>
                                </table>
                            </div>
                            @Else
                            <div class="row">
                        		<span class="h5 text-center text-success">Sin pendientes.</span>
                        	</div>
                            @Endif
                        </div>
                        <br />
                        <div class="card">
                        	<div class="card-header"><strong>TRASPASOS SALIENTE ( TS )</strong></div>
                        	@if ($tienda->traspasosorigen()->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                    	<tr>
                                    		<th>TIENDA DESTINO</th>
                                    		<th>FECHA</th>
                                    		<th>FOLIO</th>
                                    		<th>ARCHIVO DE APLICACI&Oacute;N</th>
                                    		<th>FECHA DE DETECCI&Oacute;N</th>
                                    	</tr>
                                    </thead>
                                    <tbody>
                                    	@foreach ($tienda->traspasosorigen()->get() as $traspasosaliente)
                                    	<tr>
                                    		<td>{{ $traspasosaliente->tiendadestino->nombre }}</td>
                                    		<td>{{ $traspasosaliente->fecha }}</td>
                                    		<td>{{ $traspasosaliente->folio }}</td>
                                    		<td>{{ $traspasosaliente->archivo }}</td>
                                    		<td>{{ $traspasosaliente->created_at }}</td>
                                    	</tr>
                                    	@endforeach
                                    </tbody>
                                </table>
                            </div>
                            @Else
                            <div class="row">
                        		<span class="h5 text-center text-success">Sin pendientes.</span>
                        	</div>
                            @Endif
                        </div>
                        <br />
                        <div class="card">
                        	<div class="card-header"><strong>ENTRADA DE MERCANC&Iacute;A ( EME )</strong></div>
                        	@if ($tienda->embarquemercancias()->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                    	<tr>
                                    		<th>TIPO</th>
                                    		<th>CONSECUTIVO</th>
                                    		<th>FECHA</th>
                                    		<th>ARCHIVO DE APLICACI&Oacute;N</th>
                                    		<th>FECHA DE DETECCI&Oacute;N</th>
                                    	</tr>
                                    </thead>
                                    <tbody>
                                    	@foreach ($tienda->embarquemercancias()->get() as $embarquemerca)
                                    		<?php 
                                    		switch ($embarquemerca->tipo){
                                    		    case 'SR':
                                    		        $tipo = "DISTRIBUCION";
                                    		        break;
                                    		    case 'MC':
                                    		        $tipo = "MOVIMIENTOS DE CALIDAD";
                                    		        break;
                                    		    case 'PE':
                                    		        $tipo = "PEDIDOS ESPECIALES";
                                    		        break;
                                    		    case 'TR':
                                    		        $tipo = "TRASPASOS";
                                    		        break;
                                    		    default:
                                    		        $tipo = $embarquemerca->tipo;
                                    		}
                                    		?>
                                    	<tr>
                                    		<td>{{ $tipo }}</td>
                                    		<td>{{ $embarquemerca->consecutivo }}</td>
                                    		<td>{{ $embarquemerca->fecha }}</td>
                                    		<td>{{ $embarquemerca->archivo }}</td>
                                    		<td>{{ $embarquemerca->created_at }}</td>
                                    	</tr>
                                    	@endforeach
                                    </tbody>
                                </table>
                            </div>
                            @Else
                            <div class="row">
                        		<span class="h5 text-center text-success">Sin pendientes.</span>
                        	</div>
                            @Endif
                        </div>
                        <br />
                        <div class="card">
                        	<div class="card-header"><strong>ENTRADA DE MATERIALES ( EMAT )</strong></div>
                        	@if ($tienda->embarquemateriales()->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                    	<tr>
                                    		<th>FECHA</th>
                                    		<th>ARCHIVO DE APLICACI&Oacute;N</th>
                                    		<th>FECHA DE DETECCI&Oacute;N</th>
                                    	</tr>
                                    </thead>
                                    <tbody>
                                    	@foreach ($tienda->embarquemateriales()->get() as $embarquemat)
                                    	<tr>
                                    		<td>{{ $embarquemat->fecha }}</td>
                                    		<td>{{ $embarquemat->archivo }}</td>
                                    		<td>{{ $embarquemat->created_at }}</td>
                                    	</tr>
                                    	@endforeach
                                    </tbody>
                                </table>
                            </div>
                            @Else
                            <div class="row">
                        		<span class="h5 text-center text-success">Sin pendientes.</span>
                        	</div>
                            @Endif
                        </div>
                        <br />
                        <div class="card">
                        	<div class="card-header"><strong>DEVOLUCIONES ( DEV )</strong></div>
                        	@if ($tienda->devoluciones()->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                    	<tr>
                                    		<th>DOCUMENTO SAP</th>
                                    		<th>FECHA</th>
                                    		<th>ARCHIVO DE APLICACI&Oacute;N</th>
                                    		<th>FECHA DE DETECCI&Oacute;N</th>
                                    	</tr>
                                    </thead>
                                    <tbody>
                                    	@foreach ($tienda->devoluciones()->get() as $dev)
                                    	<tr>
                                    		<td>{{ $dev->documento_sap }}</td>
                                    		<td>{{ $dev->fecha }}</td>
                                    		<td>{{ $dev->archivo }}</td>
                                    		<td>{{ $dev->created_at }}</td>
                                    	</tr>
                                    	@endforeach
                                    </tbody>
                                </table>
                            </div>
                            @Else
                            <div class="row">
                        		<span class="h5 text-center text-success">Sin pendientes.</span>
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
