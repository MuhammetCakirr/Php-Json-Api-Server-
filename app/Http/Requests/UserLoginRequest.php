<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|max:13|min:6|',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Please fill in the email field.',
            'password.required' => 'Please fill in the password field.',
            'email.email' => 'Please enter the email in the correct format.',
            'password.max' => 'Password must be a maximum of 13 characters.',
            'password.min' => 'Password must be at least 6 characters.',
        ];
    }
}
