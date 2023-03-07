<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reservalunch
 *
 * @property $id
 * @property $cliente_id
 * @property $fecha
 * @property $user_id
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @property Cliente $cliente
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Reservalunch extends Model
{
    
    static $rules = [
		'cliente_id' => 'required',
		'fecha' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cliente_id','fecha','user_id','estado'];


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
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
