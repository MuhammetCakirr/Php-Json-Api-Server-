<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        if ($this->has('email')) {
            $rules['email'] = [
                'sometimes',
                'email',
                Rule::unique('user')->ignore($this->user),
            ];
        }
        if ($this->has('password')) {
            $rules['password'] = [
                'sometimes',
                'string',
                'min:6',
                'max:13',

            ];
        }
        if ($this->has('name')) {
            $rules['name'] = [
                'sometimes',
                'string',
                'min:3',
                'max:255',
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'email.email' => 'Please enter the Email in the correct format.',
            'email.unique' => 'This email is being used by someone else.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.max' => 'Password must be a maximum of 13 characters.',
            'password.confirmed' => 'Şifreler eşleşmiyor.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name must be a maximum of 255 characters.',
        ];
    }
}
