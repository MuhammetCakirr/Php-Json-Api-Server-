<?php

namespace App\Http\Requests;

use App\Models\UnauthorizedAccessLog;
use Illuminate\Foundation\Http\FormRequest;

class BookUserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $hasPermission = $this->user()->hasPermissionTo('userbook management');

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

        return $this->user()->hasPermissionTo('userbook management');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:user,id',
            'book_id' => 'required|exists:book,id',
            'status_id' => 'required|exists:status,id',
        ];
    }

    public function messages(): array
    {
        return [
            'book_id.required' => 'Book cannot be empty.',
            'user_id.required' => 'User cannot be empty.',
            'status_id.required' => 'Status cannot be empty.',
            'book_id.exists' => 'The selected book id is invalid.',
            'user_id.exists' => 'The selected user id is invalid.',
            'status_id.exists' => 'The selected status id is invalid.',
        ];
    }
}
