<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'message'];
}
