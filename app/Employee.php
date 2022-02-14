<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'emp_name', 'institution_id', 'appation_date', 'age',
        'primary_sal', 'email' ,'tax_value','password',

    ];
    protected $primaryKey = 'id';
    protected $table = 'employees';

    public function institution ()
    {
        return $this->belongsTo('App\Institution','institution_id', 'id');
    }
    public function employee ()
    {
        return $this->belongsTo('App\Invoice','invoice_id', 'id');
    }


}
