<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            'iframe' => ['required_unless:type,local'],
            'noviews' => ['required', 'numeric'],
            'minutes_views' => ['required', 'numeric'],
            'video_file' => ['required_if:type,local'],
            'type' => ['required'],
            'video_duration' => ['required','numeric'],
            'title' => ['required'],
            'level' => ['required'],
        ];
    }
}
