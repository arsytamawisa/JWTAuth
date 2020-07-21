<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
             'name'      => 'required|max:50',
             'email'     => 'required|unique:users',
             'password'  => 'required|min:4',
        ];
    }
}
