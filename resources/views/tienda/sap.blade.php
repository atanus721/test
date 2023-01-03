@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Server</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped employees_table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Fecha Contratacion</th>
                                <th scope="col">Salario</th>
                                <th scope="col">Acciones</th>
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

@section('scripts')

<script>
    $(document).ready(function() {
        $('.employees_table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{route('tiendas.server')}}",
            dataType: 'json',
            type: "POST",
            columns: [{
                    data: 'nombre',
                    name: 'nombre'
                }
            ],
        })
    })
</script>
@endsection