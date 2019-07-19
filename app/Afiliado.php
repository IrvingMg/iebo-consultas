<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Afiliado extends Model
{
    protected $fillable = [ 
        'tabla',
        'afiliacion',
        'nombre',
        'mvto',
        'fec_mvto',
        'curp',
        'matricula',
        'semestre',
        'num_p',
        'nom_p',
        'umf'
    ];

    public $timestamps = false;
}
