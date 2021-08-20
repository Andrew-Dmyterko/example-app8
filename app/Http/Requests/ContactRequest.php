<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required|min:5|max:50',
            'message' => 'required|min:15|max:500'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Имя',
//            'email' => 'required|email',
            'subject' => 'Тема',
            'message' => 'Сообщение'
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
            'required'    => 'Поле ":attribute" является обязательным.',
            'min'    => 'Поле ":attribute" должно быть не меньше :min символов.',
            'max'    => 'Поле :attribute должно быть не больше :max символов.',
            'email' => 'Введите в поле ":attribute" корректный ел.адрес.',
//            'in'      => 'The :attribute must be one of the following types: :values',
        ];
    }


}
