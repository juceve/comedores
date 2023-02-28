<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Invdetalle
 *
 * @property $id
 * @property $tipo
 * @property $inventario_id
 * @property $producto_id
 * @property $cantidad
 * @property $subtotal
 * @property $created_at
 * @property $updated_at
 *
 * @property Inventario $inventario
 * @property Producto $producto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Invdetalle extends Model
{
    
    static $rules = [
		'tipo' => 'required',
		'inventario_id' => 'required',
		'producto_id' => 'required',
		'cantidad' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo','inventario_id','producto_id','cantidad','subtotal'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inventario()
    {
        return $this->hasOne('App\Models\Inventario', 'id', 'inventario_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'producto_id');
    }
    

}
