<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['name','email','password','token'];
}
