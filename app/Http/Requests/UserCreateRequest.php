<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6|max:13',
            'name' => 'required|min:3|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name cannot be empty.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be a maximum of 255 characters.',
            'email.required' => 'Email cannot be empty.',
            'email.email' => 'Please enter the Email in the correct format.',
            'email.unique' => 'This email is being used by someone else.',
            'password.required' => 'Password cannot be empty.',
            'password.min' => 'Password must be at least 6 characters..',
            'password.max' => 'Password must be a maximum of 13 characters.',
        ];
    }
}
