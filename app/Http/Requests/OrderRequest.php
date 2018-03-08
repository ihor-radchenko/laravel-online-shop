<?php

namespace AutoKit\Http\Requests;

use AutoKit\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'customer_name' => 'required|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone_number' => ['required', new PhoneNumber]
        ];
    }
}
