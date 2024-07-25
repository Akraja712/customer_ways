<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'unique_name' => 'required|string',
            'avatar' => 'nullable|profile',
            'refer_code' => 'nullable|string',
            'referred_by' => 'nullable|string',
            'points' => 'required|integer',
            'mobile' => 'required|integer',
            'datetime' => 'nullable|datetime',
            'verified' => 'nullable|boolean',
            'online_status' => 'nullable|boolean',
            'dummy' => 'nullable|boolean',
            'message_notify' => 'nullable|boolean',
            'add_friend_notify' => 'nullable|boolean',
            'view_notify' => 'nullable|boolean',
            'profile_verified' => 'nullable|boolean',
            'become_an_seller' => 'nullable|boolean',
            'cover_img_verified' => 'nullable|boolean',
            'last_Seen' => 'nullable|datetime',
            'dob' => 'nullable|date',
        ];
    }
}
