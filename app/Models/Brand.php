<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'organization_id',
        'name',
        'description',
        'status',
    ];
}
