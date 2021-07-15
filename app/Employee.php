<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    public $fillable = ['id', 'name', 'email','contact_number','position'];
}
