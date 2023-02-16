<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Franja
 *
 * @property $id
 * @property $nombre
 * @property $horainicio
 * @property $horafinal
 * @property $created_at
 * @property $updated_at
 *
 * @property Entrega[] $entregas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
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
    protected $fillable = ['nombre','horainicio','horafinal'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entregas()
    {
        return $this->hasMany('App\Models\Entrega', 'franja_id', 'id');
    }
    

}
