<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $guarded = ['_token'];

    /**
     * связь продукта и галлереи
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productGallary(){

        return  $this->belongsTo(Product::class, 'product_id');
    }
}
