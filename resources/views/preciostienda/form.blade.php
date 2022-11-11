<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('id_sap') }}
            {{ Form::text('id_sap', $preciostienda->id_sap, ['class' => 'form-control' . ($errors->has('id_sap') ? ' is-invalid' : ''), 'placeholder' => 'Id Sap']) }}
            {!! $errors->first('id_sap', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('sku') }}
            {{ Form::text('sku', $preciostienda->sku, ['class' => 'form-control' . ($errors->has('sku') ? ' is-invalid' : ''), 'placeholder' => 'Sku']) }}
            {!! $errors->first('sku', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precioa') }}
            {{ Form::text('precioa', $preciostienda->precioa, ['class' => 'form-control' . ($errors->has('precioa') ? ' is-invalid' : ''), 'placeholder' => 'Precioa']) }}
            {!! $errors->first('precioa', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('preciob') }}
            {{ Form::text('preciob', $preciostienda->preciob, ['class' => 'form-control' . ($errors->has('preciob') ? ' is-invalid' : ''), 'placeholder' => 'Preciob']) }}
            {!! $errors->first('preciob', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precioc') }}
            {{ Form::text('precioc', $preciostienda->precioc, ['class' => 'form-control' . ($errors->has('precioc') ? ' is-invalid' : ''), 'placeholder' => 'Precioc']) }}
            {!! $errors->first('precioc', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('preciod') }}
            {{ Form::text('preciod', $preciostienda->preciod, ['class' => 'form-control' . ($errors->has('preciod') ? ' is-invalid' : ''), 'placeholder' => 'Preciod']) }}
            {!! $errors->first('preciod', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>