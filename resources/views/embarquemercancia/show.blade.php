@extends('layouts.app')

@section('template_title')
    {{ $embarquemercancia->name ?? 'Show Embarquemercancia' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Embarquemercancia</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('embarquemercancias.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Tienda:</strong>
                            {{ $embarquemercancia->id_tienda }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $embarquemercancia->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Consecutivo:</strong>
                            {{ $embarquemercancia->consecutivo }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $embarquemercancia->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Archivo:</strong>
                            {{ $embarquemercancia->archivo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
