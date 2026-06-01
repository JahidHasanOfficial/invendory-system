<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workstation extends Model
{
    protected $guarded = ['id'];

    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }
}
