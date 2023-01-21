<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{

    // public function authorize()
    // {
    //     return true;
    // }
    // protected $redirect = '/notauth';

    public function rules()
    {
        return [
            'category_id' => 'nullable',
            'title' => 'required|max:255',
            'short_content' => 'required',
            'content' => 'required',
            'photo' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'tags' => 'string'
        ];
    }
}
