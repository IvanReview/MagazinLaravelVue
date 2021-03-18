<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['_token'];

    //один коммент содержит много ответов
    public function replies()
    {
        return  $this->hasMany(Comment::class, 'parent_id');
    }

    public function commentator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    //ответ пренадлежит 1 комменту
    public function parentComment()
    {
        return $this->belongsTo(Comment::class);
    }



    //скоуп берем только родительские комментарии
    public function scopeParent($query)
    {
        return $query->where('parent_id', 0);
    }

    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }
}
