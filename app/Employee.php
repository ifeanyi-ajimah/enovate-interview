<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = [
        'name', 'email', 'phone','photo','company_id',
    ];



    public  function company(){
        return $this->belongsTo('App\Company');
    }

}
