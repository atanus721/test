<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Devolucione
 *
 * @property $id
 * @property $id_tienda
 * @property $documento_sap
 * @property $fecha
 * @property $archivo
 * @property $created_at
 * @property $updated_at
 *
 * @property Tienda $tienda
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Devolucione extends Model
{
    
    static $rules = [
		'id_tienda' => 'required',
		'documento_sap' => 'required',
		'fecha' => 'required',
		'archivo' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_tienda','documento_sap','fecha','archivo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tienda()
    {
        return $this->hasOne('App\Models\Tienda', 'id', 'id_tienda');
    }
    

}
