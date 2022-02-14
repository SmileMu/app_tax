<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'institution_id', 'employee_id', 'tax_value', 'date',


         ];




    public function employee()
    {
        return $this->belongsTo('App\Employee','foreign_key:employee_id', 'local_key:id');

    }

    public function institution()
    {
        return $this->belongsTo('App\Institution','foreign_key:institution_id', 'local_key:id');

    }
}
