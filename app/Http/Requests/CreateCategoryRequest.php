<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|min:3',
            'code'          => 'required|unique:categories|min:3',
            'description'   => 'required|string|max:500|min:2',
            'image'         => 'required|image|mimes:jpeg,png,jpg',
            'parent_id'     => 'required|numeric'
        ];


    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
            'description'=> 'Описание',
            'code'=> 'Код',
            'image' => 'Изображение',
            'parent_id' => "Родительская категория"
        ];
    }

    public function messages()
    {
        return [
            'required'      =>  'Поле :attribute обязательно для заполнения',
            'min'           =>  'Поле :attribute должно иметь минимум :min символа',
            'unique'        =>  'Поле :attribute должно быть уникальным'
        ];
    }
}
