<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddPackage extends FormRequest
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
            "client_id" => "required|integer|exists:clients,id",
            "name" => "required|string",
            "email" => "nullable|string|email",
            "phone_number" => "nullable|string|max:18|min:9",
            "services" => "required|array",
            "services.*.name" => "required|string",
            "services.*.service_id" => "required|integer|exists:services,id",
            "services.*.host" => "nullable|string",
            "services.*.expiry_date" => "nullable|date|date_format:Y-m-d|after:now"
        ];
    }

    /**
     * If validator fails return the exception in json form
     * @param Validator $validator
     * @return array
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'statusCode' => 422,
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
