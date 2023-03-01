<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $producto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Categoria') }}
            {{-- {{ Form::text('categoriaproducto_id', $producto->categoriaproducto_id, ['class' => 'form-control' . ($errors->has('categoriaproducto_id') ? ' is-invalid' : ''), 'placeholder' => 'Categoriaproducto Id']) }} --}}
            {!! Form::select('categoriaproducto_id', $categorias, $producto->categoriaproducto_id?$producto->categoriaproducto_id:null, ['class' => 'form-control' . ($errors->has('categoriaproducto_id') ? ' is-invalid' : ''), 'placeholder' => '- Seleccionar -']) !!}
            {!! $errors->first('categoriaproducto_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precio venta') }}
            {{ Form::number('precioventa', $producto->precioventa, ['step' => 'any','class' => 'form-control' . ($errors->has('precioventa') ? ' is-invalid' : ''), 'placeholder' => 'Precio venta']) }}
            {!! $errors->first('precioventa', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precio compra') }}
            {{ Form::number('preciocompra', $producto->preciocompra, ['step' => 'any','class' => 'form-control' . ($errors->has('preciocompra') ? ' is-invalid' : ''), 'placeholder' => 'Precio compra']) }}
            {!! $errors->first('preciocompra', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
    </div>
</div>