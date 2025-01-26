<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'tabela_de_precos_id'];

    public function tabelaDePrecos()
    {
        return $this->belongsTo(TabelaPreco::class, 'tabela_de_precos_id');
    }
}
