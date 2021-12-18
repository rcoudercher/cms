<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
          'key' => 'required|max:11|unique:comments',
          'user_id' => 'required|integer|exists:users,id',
          'article_id' => 'required|integer|exists:articles,id',
          'content' => 'required|string|max:10000',
        ];
    }
}
