<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    //
    public $timestamps = false;
    protected $table = 'sample';

    protected $fillable = [
        'name',
        'random_number',
        'age'
    ];
}
