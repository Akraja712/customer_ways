<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellersStoreRequest extends FormRequest
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
            'your_name' => 'nullable|string',
            'store_name' => 'nullable|string',
            'mobile' => 'nullable|integer',
            'email' => 'nullable|string',
            'category' => 'nullable|string',
            'store_address' => 'nullable|string',
            'seller_status' => 'nullable|boolean',
            
        ];
    }
}
