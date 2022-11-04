<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kyslik\ColumnSortable\Sortable;

/**
 * Class Tienda
 *
 * @property $id
 * @property $id_sap
 * @property $nombre
 * @property $usuarioftp
 * @property $passwdftp
 * @property $created_at
 * @property $updated_at
 *
 * @property Embarquemateriale[] $embarquemateriales
 * @property Embarquemercancia[] $embarquemercancias
 * @property Precio[] $precios
 * @property Traspaso[] $traspasos
 * @property Traspaso[] $traspasos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tienda extends Model
{
    use Sortable;
    
    static $rules = [
		'id_sap' => 'required',
		'nombre' => 'required',
		'usuarioftp' => 'required',
		'passwdftp' => 'required',
    ];
    

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_sap','nombre','usuarioftp','passwdftp'];
    
    public $sortable = ['nombre','id_sap'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function embarquemateriales()
    {
        return $this->hasMany('App\Models\Embarquemateriale', 'id_tienda', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function embarquemercancias()
    {
        return $this->hasMany('App\Models\Embarquemercancia', 'id_tienda', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function precios()
    {
        return $this->hasMany('App\Models\Precio', 'id_tienda', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function traspasosdestino()
    {
        return $this->hasMany('App\Models\Traspaso', 'id_tienda_destino', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function traspasosorigen()
    {
        return $this->hasMany('App\Models\Traspaso', 'id_tienda_origen', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devoluciones()
    {
        return $this->hasMany('App\Models\Devolucione', 'id_tienda', 'id');
    }

}
