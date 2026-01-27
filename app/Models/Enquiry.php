<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'source',
        'mobile',
        'email',
        'status',
    ];
}
