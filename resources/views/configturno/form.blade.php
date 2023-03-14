<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('turno_id') }}
            {{ Form::text('turno_id', $configturno->turno_id, ['class' => 'form-control' . ($errors->has('turno_id') ? ' is-invalid' : ''), 'placeholder' => 'Turno Id']) }}
            {!! $errors->first('turno_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('franja_id') }}
            {{ Form::text('franja_id', $configturno->franja_id, ['class' => 'form-control' . ($errors->has('franja_id') ? ' is-invalid' : ''), 'placeholder' => 'Franja Id']) }}
            {!! $errors->first('franja_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('generareserva') }}
            {{ Form::text('generareserva', $configturno->generareserva, ['class' => 'form-control' . ($errors->has('generareserva') ? ' is-invalid' : ''), 'placeholder' => 'Generareserva']) }}
            {!! $errors->first('generareserva', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('reservafranja') }}
            {{ Form::text('reservafranja', $configturno->reservafranja, ['class' => 'form-control' . ($errors->has('reservafranja') ? ' is-invalid' : ''), 'placeholder' => 'Reservafranja']) }}
            {!! $errors->first('reservafranja', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>