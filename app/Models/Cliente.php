<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 *
 * @property $id
 * @property $nombre
 * @property $cargo
 * @property $empresa
 * @property $cedula
 * @property $estado
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cliente extends Model
{

  static $rules = [
    'nombre' => 'required',
    'cedula' => 'required|unique:clientes',
    'estado' => 'required',
    'empresa_id' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['nombre', 'cargo', 'empresa_id', 'cedula', 'estado'];

  public function empresa()
  {
    return $this->hasOne('App\Models\Empresa', 'id', 'empresa_id');
  }
}
