<?php

namespace App\Http\Requests\Employer;

use Illuminate\Foundation\Http\FormRequest;

class EmployerCreateRequest extends FormRequest
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
            'company_name' => 'required|string|min:2|max:255',
            'company_email' => 'required|email|max:255',
            'company_address' => 'required|string|max:255',
            'user_id' => 'required|int|exists:users,id'
        ];
    }
}