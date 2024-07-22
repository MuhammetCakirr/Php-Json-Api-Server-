<?php

namespace App\Http\Requests;

use App\Models\UnauthorizedAccessLog;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:3|max:255',
            'published_date' => 'required|date|before:tomorrow',
            'author_id' => 'required|exists:author,id',
            'genre_id' => 'required|valid_genre_ids',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title cannot be empty.',
            'title.min' => 'Title must be at least 3 characters.',
            'title.max' => 'Title must be a maximum of 255 characters',
            'description.required' => 'Description cannot be empty.',
            'description.min' => 'Description must be at least 3 characters.',
            'description.max' => 'Description must be a maximum of 255 characters',
            'published_date.required' => 'Published date cannot be empty.',
            'published_date.date' => 'Published date format must be date.',
            'published_date.before' => 'Date must be before today',
            'author_id.exists' => 'The selected author id is invalid.',
            'genre_id.required' => 'Genre ids are required.',
            'genre_id.valid_genre_ids' => 'One or more selected genres are invalid.',
        ];
    }
}
