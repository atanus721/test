<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Embarquemercancia
 *
 * @property $id
 * @property $id_tienda
 * @property $tipo
 * @property $consecutivo
 * @property $fecha
 * @property $archivo
 * @property $created_at
 * @property $updated_at
 *
 * @property Tienda $tienda
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Embarquemercancia extends Model
{
    
    static $rules = [
		'id_tienda' => 'required',
		'tipo' => 'required',
		'consecutivo' => 'required',
		'fecha' => 'required',
		'archivo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_tienda','tipo','consecutivo','fecha','archivo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tienda()
    {
        return $this->hasOne('App\Models\Tienda', 'id', 'id_tienda');
    }
    

}
