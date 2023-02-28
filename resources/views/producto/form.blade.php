<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $producto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('categoriaproducto_id') }}
            {{ Form::text('categoriaproducto_id', $producto->categoriaproducto_id, ['class' => 'form-control' . ($errors->has('categoriaproducto_id') ? ' is-invalid' : ''), 'placeholder' => 'Categoriaproducto Id']) }}
            {!! $errors->first('categoriaproducto_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precioventa') }}
            {{ Form::text('precioventa', $producto->precioventa, ['class' => 'form-control' . ($errors->has('precioventa') ? ' is-invalid' : ''), 'placeholder' => 'Precioventa']) }}
            {!! $errors->first('precioventa', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('preciocompra') }}
            {{ Form::text('preciocompra', $producto->preciocompra, ['class' => 'form-control' . ($errors->has('preciocompra') ? ' is-invalid' : ''), 'placeholder' => 'Preciocompra']) }}
            {!! $errors->first('preciocompra', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>