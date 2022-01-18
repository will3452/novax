<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequests extends FormRequest
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
            'name' => '',
            'username' => 'required|unique:users,username|max:20',
            'gender' => 'required',
            'birth_day' => 'required',
            'email' => '',
            'password' => 'required|min:6',
        ];
    }
}
