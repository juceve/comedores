<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('entregas_id') }}
            {{ Form::text('entregas_id', $entregasmanuale->entregas_id, ['class' => 'form-control' . ($errors->has('entregas_id') ? ' is-invalid' : ''), 'placeholder' => 'Entregas Id']) }}
            {!! $errors->first('entregas_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $entregasmanuale->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ip') }}
            {{ Form::text('ip', $entregasmanuale->ip, ['class' => 'form-control' . ($errors->has('ip') ? ' is-invalid' : ''), 'placeholder' => 'Ip']) }}
            {!! $errors->first('ip', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>