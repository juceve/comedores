<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Entrega
 *
 * @property $id
 * @property $fecha
 * @property $cliente_id
 * @property $franja_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property Franja $franja
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Entrega extends Model
{
    
    static $rules = [
		'fecha' => 'required',
		'cliente_id' => 'required',
		'franja_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','cliente_id','franja_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cliente()
    {
        return $this->hasOne('App\Models\Cliente', 'id', 'cliente_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function franja()
    {
        return $this->hasOne('App\Models\Franja', 'id', 'franja_id');
    }
    

}
