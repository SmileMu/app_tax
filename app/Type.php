<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'type_name',
        'description',
];
protected $primaryKey = 'id';
protected $table = 'types';

    public function institution()
    {
        return $this->hasMany('App\Institution','foreign_key:institution_id', 'local_key:id');

    }




}
