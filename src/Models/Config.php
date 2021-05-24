<?php

namespace ronannc\plugin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;

    //definindo nome da tabela
    protected $table = 'config';

    //definindo colunas editaveis pelo usuario
    protected $fillable = [
        'client_code',
        'client_key',
    ];
}
