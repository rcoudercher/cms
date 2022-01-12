<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreArticleRequest extends FormRequest
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
  
  protected function prepareForValidation()
  {
    $this->merge([
      'slug' => Str::slug($this->title, '-')
    ]);
  }

  /**
  * Get the validation rules that apply to the request.
  *
  * @return array
  */
  public function rules()
  {
    return [
      'key' => 'required|max:11|unique:articles',
      'author_id' => 'required|numeric',
      'category_id' => 'required|numeric',
      'image_id' => 'required|numeric',
      'title' => 'required|max:230',
      'description' => 'required|max:500',
      'content' => 'required|max:5000',
      'slug' => 'required|max:255|unique:articles',
    ];
  }
}
