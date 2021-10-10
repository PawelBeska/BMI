<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CalculateBmiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'weight' => ['required', 'integer', 'min:0', 'max:600'],
            'height' => ['required', 'integer', 'min:60', 'max:280'],
            'male' => ['boolean', 'required'],
            'age' => ['required', 'integer', 'min:10', 'max:100'],

        ];
    }
}
