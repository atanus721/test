@extends('layouts.app')
@section('css')
<!--link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="style"-->
<link rel="stylesheet" href="{{ asset('datatables\datatables.min.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Server</div>
                <div class="card-body">
                    <table id="users" class="table table-bordered table-striped " style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">No Sap</th>
                                <th scope="col">SKU</th>
                                <th scope="col">Precios A</th>
                                <th scope="col">Precios B</th>
                                <th scope="col">Precios C</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script-->

<!--script src="https://code.jquery.com/"></script-->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#users').DataTable({
			language: {
			"url": 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
			},
			lengthMenu: [[10, 30, 60, 120, 180, -1], [10, 30, 60, 120, 180, 'Todos']],
			columnDefs: [ {orderable: false, targets: [4]}, { targets: [0,1,2] } ],
            serverSide: true,
			ajax: "{{route('server.getUsers')}}",
			dataType: 'json',
            type: "POST",
            data: null,
			ajax: function( data, callback, setting ){
				var out = [];

				for ( var i=data.start, ien=data.start+data.length; i<ien; i++ ){
					out.push( [  
						i+'-1', i+'-2', i+'-3', i+'-4', i+'-5'
					
					] )
				}

				setTimeout( function () {
					callback( {
						draw: data.draw,						
						outcolumns: [
							{data: 'id_sap', name: 'id_sap'},  
							{data: 'sku', name: 'sku'}, 
							{data: 'precioa', name: 'precioa'},
							{data: 'preciob', name: 'preciob'},
							{data: 'precioc', name: 'precioc'},
							{data: 'preciod', name: 'preciod'}
						],
						recordsTotal: 5000000,
						recordsFiltered: 5000000
					} );
				}, 50 );
			},
			sscrollY: 200,
			scroller: { loadingIndicator: true},
        })     
    })
</script>
@endsection