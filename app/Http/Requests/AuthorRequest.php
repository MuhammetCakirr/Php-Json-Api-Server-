<?php

namespace App\Http\Requests;

use App\Models\UnauthorizedAccessLog;
use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {

        $hasPermission = $this->user()->hasPermissionTo('author management');

        if (! $hasPermission) {

            $cacheKey = 'unauthorized_access_'.$this->user()->id.'_'.$this->ip();

            if (! cache()->has($cacheKey)) {
                UnauthorizedAccessLog::create([
                    'user_id' => $this->user()->id,
                    'ip_address' => $this->ip(),
                    'requested_url' => $this->fullUrl(),
                    'attempted_at' => now(),
                ]);

                cache()->put($cacheKey, true, now()->addMinutes(5));
            }
        }

        return $this->user()->hasPermissionTo('author management');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:3',
                'max:255',
            ],
            'biography' => 'required|min:3|max:255',
            'dateofbirth' => 'required|date|before:today',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'name cannot be empty.',
            'name.min' => 'name must be at least 3 characters.',
            'name.max' => 'name must be a maximum of 255 characters.',
            'biography.required' => 'biography cannot be empty.',
            'biography.min' => 'biography must be at least 3 characters.',
            'biography.max' => 'biography must be a maximum of 255 characters.',
            'dateofbirth.required' => 'Birthday date cannot be empty.',
            'dateofbirth.date' => 'Birthday date format must be date.',
            'dateofbirth.before' => 'Birthday must be before today.',
        ];
    }
}
