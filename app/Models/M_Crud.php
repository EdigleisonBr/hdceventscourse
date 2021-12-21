<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class M_Crud extends Model
{
    use SoftDeletes;
    protected $table = 'product';

    // A variável fillable define quais os campos que podem ser inseridos pelo usuário do sistema no Banco.
    protected $fillable = [
        'name'
    ];

    // A propriedade $hidden age como uma lista negra de atributos. Como alternativa, você pode usar a propriedade $visible para adicionar atributos à lista de permissões.
    protected $hidden;
}
