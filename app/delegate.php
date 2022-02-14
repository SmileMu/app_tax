<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class delegate extends Model
{
    protected $fillable = [
        'del_name', 'inst_name','email','password',
    ];
        
}
