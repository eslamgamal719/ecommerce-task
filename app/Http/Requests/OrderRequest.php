<?php

namespace App\Http\Requests;

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
            'full_name' => ['required', 'max:255', 'string'],
            'email'     => ['email', 'required'],
            'mobile'    => ['required'],
            'address'   => ['required', 'max:255', 'string'],
            'city'      => ['required', 'max:255', 'string'],
            'country'   => ['required', 'max:255', 'string'],
        ];
    }
}
