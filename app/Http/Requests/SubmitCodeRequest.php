<?php

namespace App\Http\Requests;

use App\Rules\ValidCode;
use App\Rules\ValidContact;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SubmitCodeRequest extends FormRequest
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
            'type' => ['required', Rule::in(['SMS', 'Email'])],
            'contact' => ['required', new ValidContact()],
            'code' => ['required', new ValidCode($this)],
        ];
    }
}
