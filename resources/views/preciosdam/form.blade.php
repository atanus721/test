<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('id_sap') }}
            {{ Form::text('id_sap', $preciosdam->id_sap, ['class' => 'form-control' . ($errors->has('id_sap') ? ' is-invalid' : ''), 'placeholder' => 'Id Sap']) }}
            {!! $errors->first('id_sap', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('sku') }}
            {{ Form::text('sku', $preciosdam->sku, ['class' => 'form-control' . ($errors->has('sku') ? ' is-invalid' : ''), 'placeholder' => 'Sku']) }}
            {!! $errors->first('sku', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precioa') }}
            {{ Form::text('precioa', $preciosdam->precioa, ['class' => 'form-control' . ($errors->has('precioa') ? ' is-invalid' : ''), 'placeholder' => 'Precioa']) }}
            {!! $errors->first('precioa', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('preciob') }}
            {{ Form::text('preciob', $preciosdam->preciob, ['class' => 'form-control' . ($errors->has('preciob') ? ' is-invalid' : ''), 'placeholder' => 'Preciob']) }}
            {!! $errors->first('preciob', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precioc') }}
            {{ Form::text('precioc', $preciosdam->precioc, ['class' => 'form-control' . ($errors->has('precioc') ? ' is-invalid' : ''), 'placeholder' => 'Precioc']) }}
            {!! $errors->first('precioc', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('preciod') }}
            {{ Form::text('preciod', $preciosdam->preciod, ['class' => 'form-control' . ($errors->has('preciod') ? ' is-invalid' : ''), 'placeholder' => 'Preciod']) }}
            {!! $errors->first('preciod', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::text('fecha', $preciosdam->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>