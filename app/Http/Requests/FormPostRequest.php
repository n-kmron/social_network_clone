<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FormPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'owner' => 'required',
            'name' => ['required', 'min:8'],
            'content' => 'required',
            'picture_link' => ['image', 'max:5000']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'owner' => Auth::id(),
            'name' => $this->input('title'),
        ]);
    }

    public function messages()
    {
        return [
            'picture_link' => 'Your image is not in a good format or is too big.',
        ];
    }
}
