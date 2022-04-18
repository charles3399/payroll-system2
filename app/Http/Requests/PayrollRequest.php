<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayrollRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //set this to true if you're using api resource in CRUD operations
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employee_id' => ['required'],
            'days_worked' => ['required','integer','max:22','min:0'],
            'overtime' => ['required','integer','max:3','min:0'],
            'late' => ['required','integer','max:60','min:0'],
            'absences' => ['required','integer','max:3','min:0'],
            'bonuses' => ['integer','nullable','min:0'],
        ];
    }
}
