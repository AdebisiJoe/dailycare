<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Totalreg extends Model
{
  protected $table = 'totalregperday';

   public $timestamps=false;
    public $fillable = [
        'date', 'totalreg',
    ];
}
