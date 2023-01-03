@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Server</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped tienda_table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
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
        alert('d');
        $('.tienda_table').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "ajax": "{{ url url('') }}",
            "dataType": 'json',
            "type": "POST",
            "columns": [{
                    data: 'nombre',
                    name: 'nombre'
                }
            ],
        })
    });
</script>
@endsection