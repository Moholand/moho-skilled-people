<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Compare authenticated user id with url id
        if(auth()->user()->id !== (int)$this->user) {
            return false;
        }
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
            'english_full_name' => 'required|string|min:2|max:255',
            'persian_full_name' => 'required|string|min:2|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user, //Ignore the current user,
            'password' => 'required',
            'country_id' => 'required|exists:countries,id'
        ];
    }
}
