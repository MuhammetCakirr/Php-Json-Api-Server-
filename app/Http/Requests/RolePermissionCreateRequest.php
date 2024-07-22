<?php

namespace App\Http\Requests;

use App\Models\UnauthorizedAccessLog;
use Illuminate\Foundation\Http\FormRequest;

class RolePermissionCreateRequest extends FormRequest
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
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',

        ];
    }

    public function messages(): array
    {
        return [
            'role_id.required' => 'Role id cannot be empty.',
            'permission_id.required' => 'Permission id cannot be empty.',
            'role_id.exists' => 'The selected role id is invalid.',
            'permission_id.exists' => 'The selected permission id is invalid.',
        ];
    }
}
