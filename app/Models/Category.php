<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['_token'];

    public function children_cat()
    {
        return $this->hasMany(Category::class, 'parent_id');

    }

    public function scopeParentCat($query)
    {
        return $query->where('parent_id', 0);
    }
}
