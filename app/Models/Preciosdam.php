<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Preciosdam
 *
 * @property $id
 * @property $id_sap
 * @property $sku
 * @property $precioa
 * @property $preciob
 * @property $precioc
 * @property $preciod
 * @property $fecha
 * @property $created_at
 * @property $updated_at
 *
 * @property Tienda $tienda
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Preciosdam extends Model
{
    
    static $rules = [
		'id_sap' => 'required',
		'sku' => 'required',
		'precioa' => 'required',
		'preciob' => 'required',
		'precioc' => 'required',
		'preciod' => 'required',
		'fecha' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_sap','sku','precioa','preciob','precioc','preciod','fecha'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tienda()
    {
        return $this->hasOne('App\Models\Tienda', 'id_sap', 'id_sap');
    }
    

}
