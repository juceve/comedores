<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Empresa
 *
 * @property $id
 * @property $nombre
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Empresa extends Model
{
    
    static $rules = [
		'nombre' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','reportes'];

    public function clientes()
    {
        return $this->hasMany('App\Models\Cliente', 'empresa_id', 'id');
    }


}
