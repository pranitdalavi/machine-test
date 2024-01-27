<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Personaldetail extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'first_name', 'last_name', 'execution_time'];
}
