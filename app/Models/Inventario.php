<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Inventario
 *
 * @property $id
 * @property $fecha
 * @property $kiosko_id
 * @property $user_id
 * @property $estado
 * @property $cierre
 * @property $created_at
 * @property $updated_at
 *
 * @property Invdetalle[] $invdetalles
 * @property Kiosko $kiosko
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Inventario extends Model
{
    
    static $rules = [
		'fecha' => 'required',
		'kiosko_id' => 'required',
		'user_id' => 'required',
		'estado' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','kiosko_id','user_id','estado','cierre'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invdetalles()
    {
        return $this->hasMany('App\Models\Invdetalle', 'inventario_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kiosko()
    {
        return $this->hasOne('App\Models\Kiosko', 'id', 'kiosko_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    

}
