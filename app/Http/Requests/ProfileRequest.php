<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:200',
            'email' => 'required|string',
            'phone' => 'required|numeric',
            'password' => 'required|string',
        ];

        // if the avatar not null
        if ($this->hasFile('avatar')) {
            $rules['avatar'] = 'mimes:jpg,png,jpeg';
        }

        return $rules;
    }
}
