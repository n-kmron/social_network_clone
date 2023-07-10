<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegisterRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'name' => ['required'],
            'password' => ['required','min:8']
        ];


    }

    protected function prepareForValidation()
    {
        $this->merge([
            'password' => strlen($this->input('password')) >= 8 ? Hash::make($this->input('password')) : null,
        ]);
    }

    public function messages()
    {
        return [
            'password' => 'The password field is required and needs at least 8 characters.',
        ];
    }
}
