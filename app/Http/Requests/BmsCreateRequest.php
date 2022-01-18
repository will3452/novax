<?php

namespace App\Http\Requests;

use App\Models\Bms;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BmsCreateRequest extends FormRequest
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
            'height' => 'required',
            'weight' => 'required',
            'result' => 'required',
            'type' => ['required', Rule::in([Bms::TYPE_BMI, Bms::TYPE_BMR])],
        ];
    }
}
