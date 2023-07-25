<?php

namespace App\Http\Requests;

use Doctrine\Inflector\Rules\English\Rules as EnglishRules;
use Illuminate\Support\Facades\Password;
use Doctrine\Inflector\Rules\French\Rules;
use Illuminate\Foundation\Http\FormRequest;

class storeUserRequest extends FormRequest
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
            'phone' => ['required', 'unique:users', 'max:255',
            ],
            'pphone' => ['required', 'numeric', 'digits:11'],
            'government' => ['required', 'max:255',
            ],
            'level' => ['required', 'max:255',
            ],
            'password' => ['required', 'confirmed', 'max:255',
            ]
        ];
    }
}
