<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Clienteturno
 *
 * @property $id
 * @property $cliente_id
 * @property $turno_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property Turno $turno
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Clienteturno extends Model
{
    
    static $rules = [
		'cliente_id' => 'required',
		'turno_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cliente_id','turno_id'];


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
    public function turno()
    {
        return $this->hasOne('App\Models\Turno', 'id', 'turno_id');
    }
    

}
