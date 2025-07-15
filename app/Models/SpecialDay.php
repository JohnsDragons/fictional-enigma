<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialDay extends Model
{
    protected $table = 'special_days';

    protected $fillable = ['date'];
}
