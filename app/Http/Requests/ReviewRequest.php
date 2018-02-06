<?php

namespace AutoKit\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'name' => 'required|min:2|max:255',
            'title' => 'required|max:255',
            'text' => 'required',
            'rating' => 'required|integer|between:1,5',
            'product_id' => 'required|integer',
        ];
    }
}
