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
            'iframe' => ['required:video_path'],
            'noviews' => ['required'],
            'minutes_views' => ['required'],
            // 'type' => ['required'],
            'video_dauration' => ['required'],
            'title' => ['required'],
            'level' => ['required'],
        ];
    }
}
