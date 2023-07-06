<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CreatePostRequest extends FormRequest
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
            'picture_link' => ['required', 'min:8', 'regex:/[0-9a-z\-]+$/', Rule::unique('posts')->ignore($this->route()->parameter('post'))],
            'likes' => 'required',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'owner' => Auth::id(),
            'name' => $this->input('title'),
            'picture_link' => $this->input('picture_link') ?: Auth::id() .  '-' . Str::slug($this->input('title')),
            'likes' => $this->input('likes') ?: 0,
        ]);
    }
}
