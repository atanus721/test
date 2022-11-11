@extends('layouts.app')

@section('template_title')
    {{ $preciostienda->name ?? 'Show Preciostienda' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Preciostienda</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('preciostiendas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Sap:</strong>
                            {{ $preciostienda->id_sap }}
                        </div>
                        <div class="form-group">
                            <strong>Sku:</strong>
                            {{ $preciostienda->sku }}
                        </div>
                        <div class="form-group">
                            <strong>Precioa:</strong>
                            {{ $preciostienda->precioa }}
                        </div>
                        <div class="form-group">
                            <strong>Preciob:</strong>
                            {{ $preciostienda->preciob }}
                        </div>
                        <div class="form-group">
                            <strong>Precioc:</strong>
                            {{ $preciostienda->precioc }}
                        </div>
                        <div class="form-group">
                            <strong>Preciod:</strong>
                            {{ $preciostienda->preciod }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
