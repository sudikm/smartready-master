<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisteredUsers extends Model
{
    protected $table = 'registered_users';
    protected $fillable = ['sector', 'name', 'email'];
}
