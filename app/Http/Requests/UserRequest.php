<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [];

        if ($this->route()->getActionMethod() === 'register') {
            $rules = [
                'name' => 'required | String | max:20',
                'email' => 'required | email | unique:users,email',
                'password' => 'required | String ',
            ];
        }

        if ($this->route()->getActionMethod() === 'storePhoneNumber') {
            $rules['phone_number'] = 'required|string|min:10|max:15';
        }

        if ($this->route()->getActionMethod() === 'loginPersonal') {
            $rules = [
                'email' => 'required | email',
                'password' => 'required | String ',
            ];
        }

        return $rules;
    }
}
