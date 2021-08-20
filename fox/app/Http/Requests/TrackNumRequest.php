<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrackNumRequest extends FormRequest
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
            'trackNum' => 'required|digits_between:10,15|integer'
        ];
    }

    public function attributes()
    {
        return [
            'trackNum' => 'Номер декларации'
        ];
    }

    public function messages()
    {    // можно и так
//        return [
//            'name.required' => 'Поле "Имя" является обязательным',
//            'email.required' => 'Поле "email" является обязательным',
//            'subject.required' => 'Поле "тема" является обязательным',
//            'message.required' => 'Поле "сообщение" является обязательным'
//            'name.required' => 'Поле "Имя" является обязательным',
//            'email.required' => 'Поле "email" является обязательным',
//            'subject.required' => 'Поле "тема" является обязательным',
//            'message.required' => 'Поле "сообщение" является обязательным'
//        ];
        return [
            'required'  => 'Поле :attribute является обязательным.',
            'digits_between'    => 'Поле ":attribute" должно быть между :min и :max  символов.',
            'integer'   => 'Поле :attribute должно быть только цифровым.',
//            'email' => 'Введите в поле ":attribute" корректный ел.адрес.',
//            'in'      => 'The :attribute must be one of the following types: :values',
        ];
    }
}
