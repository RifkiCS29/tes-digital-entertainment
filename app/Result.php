<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['first_number', 'second_number', 'operator', 'result'];
}
