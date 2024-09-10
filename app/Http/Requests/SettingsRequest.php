<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quantity_diamonds' => 'required|numeric|min:1',
            'quantity_silver' => 'required|numeric|min:1',
            'quantity_gold' => 'required|numeric|min:1',

            'type_diamonds' => 'required|string',
            'type_silver' => 'required|string',
            'type_gold' => 'required|string',

            'dollar_diamonds' => 'required|string',
            'dollar_silver' => 'required|string',
            'dollar_gold' => 'required|string',

            'percentage' => 'required|numeric',
        ];
    }
}
