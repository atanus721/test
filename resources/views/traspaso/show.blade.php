@extends('layouts.app')

@section('template_title')
    {{ $traspaso->name ?? 'Show Traspaso' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Traspaso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('traspasos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Tienda Destino:</strong>
                            {{ $traspaso->id_tienda_destino }}
                        </div>
                        <div class="form-group">
                            <strong>Id Tienda Origen:</strong>
                            {{ $traspaso->id_tienda_origen }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $traspaso->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Folio:</strong>
                            {{ $traspaso->folio }}
                        </div>
                        <div class="form-group">
                            <strong>Archivo:</strong>
                            {{ $traspaso->archivo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
