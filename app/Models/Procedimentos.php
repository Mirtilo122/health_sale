<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Procedimentos extends Model
{
    use HasFactory;

    protected $table = 'procedimentos';
    protected $fillable = ['codigo', 'nome_procedimento', 'tipo', 'ativo'];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($procedimento) {
            $procedimento->codigo = strtoupper(Str::random(10));
        });
    }
}
