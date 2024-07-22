<?php

namespace App\Http\Requests;

use App\Models\UnauthorizedAccessLog;
use Illuminate\Foundation\Http\FormRequest;

class PermissionCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $hasPermission = $this->user()->hasPermissionTo('rolepermission management');

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

        return $this->user()->hasPermissionTo('rolepermission management');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:100|unique:permissions,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name cannot be empty.',
            'name.string' => 'Name must be in string format',
            'name.min' => 'Name must be at least 2 characters.',
            'name.max' => 'Name must be a maximum of 100 characters.',
            'name.unique' => 'A permission with this name is already being used.',

        ];
    }
}
