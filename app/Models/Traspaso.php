<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Traspaso
 *
 * @property $id
 * @property $id_tienda_destino
 * @property $id_tienda_origen
 * @property $fecha
 * @property $folio
 * @property $archivo
 * @property $created_at
 * @property $updated_at
 *
 * @property Tienda $tienda
 * @property Tienda $tienda
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Traspaso extends Model
{
    
    static $rules = [
		'id_tienda_destino' => 'required',
		'id_tienda_origen' => 'required',
		'fecha' => 'required',
		'folio' => 'required',
		'archivo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_tienda_destino','id_tienda_origen','fecha','folio','archivo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tiendadestino()
    {
        return $this->hasOne('App\Models\Tienda', 'id', 'id_tienda_destino');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tiendaorigen()
    {
        return $this->hasOne('App\Models\Tienda', 'id', 'id_tienda_origen');
    }
    

}
