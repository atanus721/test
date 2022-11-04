@extends('layouts.app')

@section('template_title')
    {{ $precio->name ?? 'Show Precio' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Precio</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('precios.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Tienda:</strong>
                            {{ $precio->id_tienda }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $precio->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Archivo:</strong>
                            {{ $precio->archivo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
