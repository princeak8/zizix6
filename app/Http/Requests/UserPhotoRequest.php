<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPhotoRequest extends FormRequest
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
        $rules = [];
            if($this->hasFile('photo')) {
                $rules['photo'] = 'required|image|mimes:jpeg,jpg,gif,bmp,png|max:2000';
            }
        return $rules;
    }
}
