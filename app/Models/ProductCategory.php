<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }
}
