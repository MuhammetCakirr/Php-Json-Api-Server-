<?php

namespace App\Http\Requests;

use App\Models\UnauthorizedAccessLog;
use Illuminate\Foundation\Http\FormRequest;

class BookUserUpdateRequest extends FormRequest
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
        $rules = [];
        if ($this->has('user_id')) {
            $rules['user_id'] = [
                'sometimes',
                'exists:user,id',
            ];
        }

        if ($this->has('status_id')) {
            $rules['status_id'] = [
                'sometimes',
                'exists:status,id',
            ];
        }

        if ($this->has('book_id')) {
            $rules['book_id'] = [
                'sometimes',
                'exists:book,id',
            ];
        }

        if ($this->has('dateofdelivery')) {
            $rules['dateofdelivery'] = [
                'sometimes',
                'date',
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'dateofdelivery.date' => 'Delivery date must be a valid date format.',
            'book_id.exists' => 'The selected book id is invalid.',
            'status_id.exists' => 'The selected status id is invalid.',
            'user_id.exists' => 'The selected user id is invalid.',
        ];
    }
}
