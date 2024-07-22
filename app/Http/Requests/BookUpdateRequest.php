<?php

namespace App\Http\Requests;

use App\Models\UnauthorizedAccessLog;
use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $hasPermission = $this->user()->hasPermissionTo('book management');

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

        return $this->user()->hasPermissionTo('book management');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [];
        if ($this->has('title')) {
            $rules['title'] = [
                'sometimes',
                'min:3',
                'max:255',
            ];
        }

        if ($this->has('description')) {
            $rules['description'] = [
                'sometimes',
                'min:3',
                'max:255',
            ];
        }

        if ($this->has('published_date')) {
            $rules['published_date'] = [
                'sometimes',
                'date',
                'before:tomorrow',
            ];
        }

        if ($this->has('author_id')) {
            $rules['author_id'] = [
                'sometimes',
                'exists:author,id',

            ];
        }

        if ($this->has('genre_id')) {
            $rules['genre_id'] = [
                'sometimes',
                'valid_genre_ids',
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.min' => 'The title must be at least 3 characters.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'description.min' => 'The description must be at least 3 characters.',
            'description.max' => 'The description may not be greater than 255 characters.',
            'published_date.date' => 'The published date must be a valid date format.',
            'published_date.before' => 'The published date must be before tomorrow.',
            'author_id.exists' => 'The selected author id is invalid.',
            'genre_id.valid_genre_ids' => 'One or more selected genres are invalid.',
        ];
    }
}
