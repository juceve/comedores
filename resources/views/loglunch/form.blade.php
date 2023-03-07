<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('tipo') }}
            {{ Form::text('tipo', $loglunch->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cliente_id') }}
            {{ Form::text('cliente_id', $loglunch->cliente_id, ['class' => 'form-control' . ($errors->has('cliente_id') ? ' is-invalid' : ''), 'placeholder' => 'Cliente Id']) }}
            {!! $errors->first('cliente_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $loglunch->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>