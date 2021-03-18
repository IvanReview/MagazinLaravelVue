<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    use HasFactory;

    protected $guarded = ['_token'];

    public function children_tree()
    {
        return $this->hasMany(Tree::class, 'parent_id');
    }
}
