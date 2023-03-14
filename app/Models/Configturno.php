<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Configturno
 *
 * @property $id
 * @property $turno_id
 * @property $franja_id
 * @property $generareserva
 * @property $reservafranja
 * @property $created_at
 * @property $updated_at
 *
 * @property Franja $franja
 * @property Turno $turno
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Configturno extends Model
{
    
    static $rules = [
		'turno_id' => 'required',
		'franja_id' => 'required',
		'generareserva' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['turno_id','franja_id','presencial','generareserva','reservafranja'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function franja()
    {
        return $this->hasOne('App\Models\Franja', 'id', 'franja_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function turno()
    {
        return $this->hasOne('App\Models\Turno', 'id', 'turno_id');
    }
    
    public function franjareserva()
    {
        return $this->hasOne('App\Models\Franja', 'id', 'reservafranja');
    }

}
