<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('id_tienda') }}
            {{ Form::text('id_tienda', $embarquemercancia->id_tienda, ['class' => 'form-control' . ($errors->has('id_tienda') ? ' is-invalid' : ''), 'placeholder' => 'Id Tienda']) }}
            {!! $errors->first('id_tienda', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipo') }}
            {{ Form::text('tipo', $embarquemercancia->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('consecutivo') }}
            {{ Form::text('consecutivo', $embarquemercancia->consecutivo, ['class' => 'form-control' . ($errors->has('consecutivo') ? ' is-invalid' : ''), 'placeholder' => 'Consecutivo']) }}
            {!! $errors->first('consecutivo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::text('fecha', $embarquemercancia->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('archivo') }}
            {{ Form::text('archivo', $embarquemercancia->archivo, ['class' => 'form-control' . ($errors->has('archivo') ? ' is-invalid' : ''), 'placeholder' => 'Archivo']) }}
            {!! $errors->first('archivo', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>