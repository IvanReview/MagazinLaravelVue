<?php

namespace App\Models;

use App\Repositories\CurrencyConversion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['_token'];


    public function category(){
        return  $this->belongsTo(Category::class);
    }

    //один продукт имеет много комментариев
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleryImages(){

        return  $this->hasMany(Gallery::class);
    }

    //подсчет общей стоимости (количество) одного товара
    public function getPriceForCount()
    {
        if (!is_null($this->pivot)){
            $totalPrice = $this->pivot->quantity * $this->price;
            return $totalPrice;
        }
        return $this->price;
    }




    /*public function getPriceAttribute($value)
    {
        //перед чтением атрибута конвертируем валюту
        return round(CurrencyConversion::convert($value), 2);
    }*/


}
