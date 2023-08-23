<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaveClient extends FormRequest
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
            "firstname" => "required|string",
            "lastname" => "string|nullable",
            "email" => "required|string|email|unique:clients,email",
            "phone_number" => "string",
            "packages" => "array",
            "packages.*.name" => "required|string|unique:client_packages,name",
            "packages.*.email" => "string|email|nullable",
            "packages.*.services" => "array",
            "packages.*.services.*.name" => "string",
            "packages.*.services.*.service_id" => "integer",
            "packages.*.services.*.host" => "string",
            "packages.*.services.*.expiry" => "date|date_format:Y-m-d|after:now",
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
