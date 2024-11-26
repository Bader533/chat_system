<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdsRequest extends FormRequest
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
            'name_en' => 'required|string|min:2|max:200',
            'name_ar' => 'required|string|min:2|max:200',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'status' => 'required|numeric|in:0,1',
            'is_home' => 'required|numeric|in:0,1'
        ];

        if ($this->isMethod('post')) {
            $rules['avatar'] = 'required|mimes:jpg,png,jpeg';
        }

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            if ($this->hasFile('avatar')) {
                $rules['avatar'] = 'nullable|mimes:jpg,png,jpeg';
            } else {
                $rules['avatar'] = 'nullable';
            }
        }

        return $rules;
    }
}
