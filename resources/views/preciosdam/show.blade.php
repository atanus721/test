@extends('layouts.app')

@section('template_title')
    {{ $preciosdam->name ?? 'Show Preciosdam' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Preciosdam</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('preciosdams.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Sap:</strong>
                            {{ $preciosdam->id_sap }}
                        </div>
                        <div class="form-group">
                            <strong>Sku:</strong>
                            {{ $preciosdam->sku }}
                        </div>
                        <div class="form-group">
                            <strong>Precioa:</strong>
                            {{ $preciosdam->precioa }}
                        </div>
                        <div class="form-group">
                            <strong>Preciob:</strong>
                            {{ $preciosdam->preciob }}
                        </div>
                        <div class="form-group">
                            <strong>Precioc:</strong>
                            {{ $preciosdam->precioc }}
                        </div>
                        <div class="form-group">
                            <strong>Preciod:</strong>
                            {{ $preciosdam->preciod }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $preciosdam->fecha }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
