<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'section_type',
        'description',

];
protected $primaryKey = 'id';
protected $table = 'sections';



public $timestamps = false;

    public function institution()
    {
        return $this->hasMany('App\Institution','foreign_key:institution_id', 'local_key:id');

    }



}
