<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'price'         => 'required|numeric',
            'count'         => 'required|numeric',
            'code'          => 'required|min:3|unique:products,code,' . $this->product->id,
            'description'   => 'required|string|min:2|max:5000',
            'category_id'   => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name'          =>  'Имя',
            'description'   =>  'Описание',
            'code'          =>  'Код',
            'image'         =>  'Изображение',
            'count'         =>  'Количество',
            'price'         =>  'Цена'
        ];
    }

    public function messages()
    {
        return [
            'required'      =>  'Поле :attribute обязательно для заполнения',
            'min'           =>  'Поле :attribute должно иметь минимум :min символа',
            'unique'        =>  'Поле :attribute должно быть уникальным',
            'mimes'         =>  'Загружаемый файл должен быть изображением',
        ];
    }
}
