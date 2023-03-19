<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Entregasmanuale extends Model
{
    
    static $rules = [
		'entrega_id' => 'required',
		'user_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['entrega_id','user_id','ip','estado'];


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
