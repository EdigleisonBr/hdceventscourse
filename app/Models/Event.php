<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // vai dizer por meio de um cast que o 'items' é um array 
    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];

    // Tudo que for enviado pelo post pode ser atualizado sem nenhuma restrição
    protected $guarded = [];

    // Um evento pertence a um usuário (belongsTo)
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    //Um evento tem muitos usuários(belongsToMany)
    public function users() {
        return $this->belongsToMany('App\Models\User');
    }

}
