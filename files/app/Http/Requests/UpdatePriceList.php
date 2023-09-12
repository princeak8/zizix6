<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePriceList extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "price_list_id" => "integer|required|exists:price_lists,id",
            "service_id" => "integer|required|exists:services,id",
            "host_id" => "integer|nullable|exists:hosts,id",
            "amount" => "numeric|nullable",
            "amount_dollar" => "numeric|nullable"
        ];
    }
}
