<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'full_name' => ['required','string','max:250','min:2'],
            'email' => ['required','email'],
            'address' => ['required','max:250'],
            'gender' => ['required','min:4'],
            'position_id' => ['required'],
        ];
    }
}
