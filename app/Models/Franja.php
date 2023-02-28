<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Franja extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'horainicio' => 'required',
		'horafinal' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','horainicio','horafinal','precio'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entregas()
    {
        return $this->hasMany('App\Models\Entrega', 'franja_id', 'id');
    }
    

}
