<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Kiosko
 *
 * @property $id
 * @property $nombre
 * @property $ubicacion
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Inventario[] $inventarios
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Kiosko extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'ubicacion' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','ubicacion','estado'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventarios()
    {
        return $this->hasMany('App\Models\Inventario', 'kiosko_id', 'id');
    }
    

}
