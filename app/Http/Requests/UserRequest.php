<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
                'fname' => ['required', 'string', 'max:255', 'min:3'],
                'lname' => ['required', 'string', 'max:255', 'min:3'],
                'email' => ['required', 'unique:users', 'numeric', 'digits:11'],
                'password' => ['required', 'confirmed', 'max:255',],
                'role' => ['required'],
        ];
    }
}
