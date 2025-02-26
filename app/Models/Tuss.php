<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuss extends Model
{
    use HasFactory;

    protected $table = 'tuss';

    protected $fillable = ['codigo', 'descricao'];
}
