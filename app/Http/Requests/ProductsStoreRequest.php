<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsStoreRequest extends FormRequest
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
            'product_type' => 'nullable|string',
            'location' => 'nullable|string',
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date',
            'product_title' => 'nullable|string',
            'product_description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'datetime' => 'nullable|datetime',
            'avatar' => 'nullable|product_image',
        ];
    }
}
