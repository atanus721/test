<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Preciostienda
 *
 * @property $id
 * @property $id_sap
 * @property $sku
 * @property $precioa
 * @property $preciob
 * @property $precioc
 * @property $preciod
 * @property $created_at
 * @property $updated_at
 *
 * @property Tienda $tienda
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Preciostienda extends Model
{
    
    static $rules = [
		'id_sap' => 'required',
		'sku' => 'required',
		'precioa' => 'required',
		'preciob' => 'required',
		'precioc' => 'required',
		'preciod' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_sap','sku','precioa','preciob','precioc','preciod'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tienda()
    {
        return $this->hasOne('App\Models\Tienda', 'id_sap', 'id_sap');
    }
    

}
