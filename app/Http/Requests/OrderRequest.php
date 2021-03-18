<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'phone'         => 'required|numeric',
            'email'         => 'required|email',
            'surname'       => 'required|min:3',
            'address'       => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
            'phone'=> 'Телефон',
            'email'=> 'Эмаил',
            'address' => 'Адрес',
            'surname' => 'Фамилия'
        ];
    }

    public function messages()
    {
        return [
            'required'      =>  'Поле :attribute обязательно для заполнения',
            'min'           =>  'Поле :attribute должно иметь минимум :min символа',
            'unique'        =>  'Поле :attribute должно быть уникальным',
            'email'         =>  'Поле :attribute должно быть валидным email адресом',
            'numeric'       =>  'Поле :attribute должно быть числовым',
            'size'          =>  'Поле :attribute должно иметь :size символов'
        ];
    }
}
