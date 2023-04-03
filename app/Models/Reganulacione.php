<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reganulacione
 *
 * @property $id
 * @property $fecha
 * @property $entrega_id
 * @property $user_id
 * @property $ip
 * @property $created_at
 * @property $updated_at
 *
 * @property Entrega $entrega
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Reganulacione extends Model
{
    
    static $rules = [
		'fecha' => 'required',
		'entrega_id' => 'required',
		'user_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','entrega_id','user_id','ip'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function entrega()
    {
        return $this->hasOne('App\Models\Entrega', 'id', 'entrega_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
