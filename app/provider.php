<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class provider extends Model
{
    
    public $timestamps = false;
    
    public $fillable = ['name','copyright_email'];
}
