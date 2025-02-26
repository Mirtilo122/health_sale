<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestador extends Model
{
    use HasFactory;
    protected $table = 'prestadores';
    protected $fillable = ['nome', 'crm', 'especialidade', 'funcao', 'usuario_id', 'especialidade_id'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}

class Usuario extends Model
{
    use HasFactory;
    protected $fillable = ['usuario', 'email', 'senha', 'acesso', 'funcao'];

    public function prestador()
    {
        return $this->hasOne(Prestador::class, 'usuario_id');
    }
}
