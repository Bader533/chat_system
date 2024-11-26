<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GlaTeamRequest extends FormRequest
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
            'title_en' => 'required|string|max:200',
            'title_ar' => 'required|string|max:200',
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'status' => 'required|numeric|in:0,1',
        ];

        if ($this->isMethod('put')) {
            $rules['title_en'] = 'nullable|string|max:200';
            $rules['title_ar'] = 'nullable|string|max:200';
            $rules['description_en'] = 'nullable|string';
            $rules['description_ar'] = 'nullable|string';
            $rules['status'] = 'nullable|numeric|in:0,1';
        }

        // if the avatar not null
        if ($this->hasFile('avatar')) {
            $rules['avatar'] = 'mimes:jpg,png,jpeg';
        }

        return $rules;
    }
}
