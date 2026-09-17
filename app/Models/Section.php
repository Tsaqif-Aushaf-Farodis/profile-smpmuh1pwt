<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

    protected $fillable = [
        'name',
        'type',
        'data',
        'active',
        'ordering',
    ];

    protected $casts = [       
        'data' => 'json',     
    ];
}
