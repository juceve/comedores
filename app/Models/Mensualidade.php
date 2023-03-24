<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Mensualidade
 *
 * @property $id
 * @property $fecha
 * @property $feccontrol
 * @property $importe
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Mensualidade extends Model
{
    
    static $rules = [
		'fecha' => 'required',
		'feccontrol' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha','feccontrol','importe'];



}
