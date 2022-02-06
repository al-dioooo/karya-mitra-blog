<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'english_title' => 'sometimes|required|max:100',
            'indonesia_title' => 'sometimes|max:100',

            'english_subtitle' => 'required_with:english_title|max:100',
            'indonesia_subtitle' => 'required_with:indonesia_title|max:100',

            'english_content' => 'required_with:english_title',
            'indonesia_content' => 'required_with:indonesia_title',

            'tag' => 'required',

            'english_meta_description' => 'required_with:english_title|max:255',
            'indonesia_meta_description' => 'required_with:indonesia_title|max:255',

            'cover' => 'image|mimes:png,jpg',
            'slug' => 'required|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:posts,slug,' . $this->post->slug . ',slug',
            'category' => 'required'
        ];
    }
}
