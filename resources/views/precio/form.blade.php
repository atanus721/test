<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('id_tienda') }}
            {{ Form::text('id_tienda', $precio->id_tienda, ['class' => 'form-control' . ($errors->has('id_tienda') ? ' is-invalid' : ''), 'placeholder' => 'Id Tienda']) }}
            {!! $errors->first('id_tienda', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::text('fecha', $precio->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('archivo') }}
            {{ Form::text('archivo', $precio->archivo, ['class' => 'form-control' . ($errors->has('archivo') ? ' is-invalid' : ''), 'placeholder' => 'Archivo']) }}
            {!! $errors->first('archivo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>