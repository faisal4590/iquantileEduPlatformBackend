<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    //
    protected $fillable = [
        'username','email','password', 
        'age', 'access_level','auth_token'
    ];

}
