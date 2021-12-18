<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateCategoryRequest extends FormRequest
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
      'slug' => Str::slug($this->slug, '-')
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
      'name' => ['required', 'max:255', 'unique:categories,name,'. $this->category->id],
      'slug' => ['required', 'max:255', 'unique:categories,slug,'. $this->category->id],
    ];
  }
}
