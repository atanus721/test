@extends('layouts.app')

@section('template_title')
    {{ $devolucione->name ?? 'Show Devolucione' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Devolucione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('devoluciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Tienda:</strong>
                            {{ $devolucione->id_tienda }}
                        </div>
                        <div class="form-group">
                            <strong>Documento Sap:</strong>
                            {{ $devolucione->documento_sap }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $devolucione->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Archivo:</strong>
                            {{ $devolucione->archivo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
