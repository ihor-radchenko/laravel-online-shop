<?php

namespace AutoKit\Http\Requests;

use AutoKit\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|max:255|min:2|string',
            'surname' => 'max:255',
            'patronymic' => 'max:255',
            'phone_number' => ['required', new PhoneNumber]
        ];
    }
}
