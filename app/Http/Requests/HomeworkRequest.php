<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeworkRequest extends FormRequest
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
            'week_id' => ['required'],
            'title' => ['required', 'max:255'],
            'level' => ['required'],
            'minutes' => ['required'],
            'start' => ['required'],
            'end' => ['required'],
        ];
    }
}
