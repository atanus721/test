<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('id_tienda_destino') }}
            {{ Form::text('id_tienda_destino', $traspaso->id_tienda_destino, ['class' => 'form-control' . ($errors->has('id_tienda_destino') ? ' is-invalid' : ''), 'placeholder' => 'Id Tienda Destino']) }}
            {!! $errors->first('id_tienda_destino', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('id_tienda_origen') }}
            {{ Form::text('id_tienda_origen', $traspaso->id_tienda_origen, ['class' => 'form-control' . ($errors->has('id_tienda_origen') ? ' is-invalid' : ''), 'placeholder' => 'Id Tienda Origen']) }}
            {!! $errors->first('id_tienda_origen', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::text('fecha', $traspaso->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('folio') }}
            {{ Form::text('folio', $traspaso->folio, ['class' => 'form-control' . ($errors->has('folio') ? ' is-invalid' : ''), 'placeholder' => 'Folio']) }}
            {!! $errors->first('folio', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('archivo') }}
            {{ Form::text('archivo', $traspaso->archivo, ['class' => 'form-control' . ($errors->has('archivo') ? ' is-invalid' : ''), 'placeholder' => 'Archivo']) }}
            {!! $errors->first('archivo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>