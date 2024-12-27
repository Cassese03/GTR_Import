<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
abstract class AR extends Model {
    protected $table = 'ar';
    //use \Awobaz\Compoships\Compoships;
    protected $fillable = ['id_ditta'];

    protected $hidden = [
        'note_ar',
        'Marca',
        'cd_arclasse3',
        'cd_argruppo1',
        'cd_argruppo2',
        'cd_argruppo3',
        'WebB2CPubblica',
        'id_ditta'
    ];


    abstract public function ar_classe_1();
    abstract public function ar_classe_2();
    abstract public function ar_classe_3();



}