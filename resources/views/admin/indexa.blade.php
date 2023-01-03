@extends('layouts.app')

<!-- Template -->
@section('template_title')
	Tienda
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    @if (Auth::user()->id == 15)
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            
                        </span>                        
                         <div class="float-center">
                        @if($errors->any())
                        <h4>{{$errors->first()}}</h4>
                        @endif
                        </div>
                        <div class="float-right">
                            <a href="{{ route('administrador.index') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Procesar precios TIENDAS') }}
                            </a>
                        </div>
                    </div>
                    <br>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">
                            
                        </span>                        
                        <div class="float-center">
                        @if($errors->any())
                        <h4>{{$errors->first()}}</h4>
                        @endif
                        </div>                        
                        <div class="float-right">
                            <a href="{{ route('administrador.show',0) }}" class="btn btn-info btn-sm float-right" data-placement="left">
                                {{ __('Procesar precios DAM') }}
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

            </div>
            <br>
            <div class="card-footer">
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('tiendas.index') }}"> Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection