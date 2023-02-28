<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $nombre
 * @property $categoriaproducto_id
 * @property $precioventa
 * @property $preciocompra
 * @property $created_at
 * @property $updated_at
 *
 * @property Categoriaproducto $categoriaproducto
 * @property Invdetalle[] $invdetalles
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'categoriaproducto_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','categoriaproducto_id','precioventa','preciocompra'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoriaproducto()
    {
        return $this->hasOne('App\Models\Categoriaproducto', 'id', 'categoriaproducto_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invdetalles()
    {
        return $this->hasMany('App\Models\Invdetalle', 'producto_id', 'id');
    }
    

}
