@extends('layouts.app')

@section('template_title')
    {{ $embarquemateriale->name ?? 'Show Embarquemateriale' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Embarquemateriale</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('embarquemateriales.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Tienda:</strong>
                            {{ $embarquemateriale->id_tienda }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $embarquemateriale->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Archivo:</strong>
                            {{ $embarquemateriale->archivo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
