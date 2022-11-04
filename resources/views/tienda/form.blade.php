<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('id_sap') }}
            {{ Form::text('id_sap', $tienda->id_sap, ['class' => 'form-control' . ($errors->has('id_sap') ? ' is-invalid' : ''), 'placeholder' => 'Id Sap']) }}
            {!! $errors->first('id_sap', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $tienda->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('usuarioftp') }}
            {{ Form::text('usuarioftp', $tienda->usuarioftp, ['class' => 'form-control' . ($errors->has('usuarioftp') ? ' is-invalid' : ''), 'placeholder' => 'Usuarioftp']) }}
            {!! $errors->first('usuarioftp', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('passwdftp') }}
            {{ Form::text('passwdftp', $tienda->passwdftp, ['class' => 'form-control' . ($errors->has('passwdftp') ? ' is-invalid' : ''), 'placeholder' => 'Passwdftp']) }}
            {!! $errors->first('passwdftp', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>