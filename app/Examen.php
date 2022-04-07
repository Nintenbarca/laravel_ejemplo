<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model{
    
    protected $fillable = [
        'fecha', 'categoria'
    ];

    protected $table = 'examenes';    
}
