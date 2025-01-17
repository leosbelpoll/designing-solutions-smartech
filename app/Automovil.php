<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Automovil extends Model
{
    protected $table = 'automoviles';

    // name <- no_placa // I changed every Selector must have a name
    protected $fillable = [
        'name', 'marca_id', 'modelo_id', 'tipo_vehiculo_id', 'tipo_combustible_id', 'description',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

    public function tipoVehiculo()
    {
        return $this->belongsTo(TipoVehiculo::class);
    }

    public function tipoCombustible()
    {
        return $this->belongsTo(TipoCombustible::class);
    }
}
