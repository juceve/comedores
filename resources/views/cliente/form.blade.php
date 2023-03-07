<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $cliente->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cargo') }}
            {{ Form::text('cargo', $cliente->cargo, ['class' => 'form-control' . ($errors->has('cargo') ? ' is-invalid' : ''), 'placeholder' => 'Cargo']) }}
            {!! $errors->first('cargo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('empresa') }}
            {{-- {{ Form::text('empresa', $cliente->empresa, ['class' => 'form-control' . ($errors->has('empresa') ? ' is-invalid' : ''), 'placeholder' => 'Empresa']) }} --}}
            {!! Form::select('empresa_id', $empresas, $cliente->empresa_id?$cliente->empresa_id:null, ['class' => 'form-control' . ($errors->has('empresa_id') ? ' is-invalid' : ''), 'placeholder' => '- Seleccione -']) !!}
            {!! $errors->first('empresa_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cedula') }}
            {{ Form::text('cedula', $cliente->cedula, ['class' => 'form-control' . ($errors->has('cedula') ? ' is-invalid' : ''), 'placeholder' => 'Cedula']) }}
            {!! $errors->first('cedula', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group d-none">
            {{ Form::label('Lunch') }}
            {{ Form::text('lunch', is_null($cliente->lunch)?1:$cliente->lunch, ['class' => 'form-control' . ($errors->has('lunch') ? ' is-invalid' : ''), 'placeholder' => 'lunch']) }}
            {!! $errors->first('lunch', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group d-none">
            {{ Form::label('estado') }}
            {{ Form::text('estado', is_null($cliente->estado)?1:$cliente->estado, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
    </div>
</div>