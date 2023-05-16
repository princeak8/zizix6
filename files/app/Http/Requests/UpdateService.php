<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateService extends FormRequest
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
            "service_id" => "required|integer|exists:services,id",
            "name" => "required_without_all:description,expiry|string",
            "description" => "required_without_all:name,expiry|string|nullable",
            "expiry" => "required_without_all:description,name|integer|nullable"
        ];
    }
}
