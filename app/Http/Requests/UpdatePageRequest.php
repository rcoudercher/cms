<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
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
      'meta_title' => 'required|max:60',
      'meta_description' => 'required|max:400',
      'title' => 'required|max:60',
      'content' => 'required|max:4000'
    ];
  }
}
