<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeWeekRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'price' => ['required'],
            'img' => ['required', 'image', 'max:3073'],
            'level' => ['required'],
        ];
    }
}
