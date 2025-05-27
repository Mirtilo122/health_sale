<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModeloPadrao extends Model
{
    protected $table = 'modelo_padroes';

    protected $fillable = [
        'tipo',
        'modelo_id',
    ];
    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }
}
