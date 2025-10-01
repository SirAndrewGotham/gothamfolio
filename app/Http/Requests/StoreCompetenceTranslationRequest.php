<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed|null $competence_id
 * @property int $user_id
 * @property int $language_id
 * @property string $name
 * @property string|null $excerpt
 * @property string $body
 * @property int|null $order
 * @property string|null $published_at
 * @property string|null $published_through
 * @property mixed|null $tags
 * @property \\App\\Enums\\CompetenceStatus $status
 * @property int|null $status_by
 * @property string|null $status_note
 */
class StoreCompetenceTranslationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'competence_id' => ['nullable', 'integer', 'exists:competences,id'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'language_id' => ['required', 'integer', 'exists:languages,id'],
            'name' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'body' => ['required', 'string'],
            'order' => ['nullable', 'integer'],
            'published_at' => ['nullable', 'date'],
            'published_through' => ['nullable', 'date'],
            'tags' => ['nullable', 'array'],
            'status' => ['required', 'string'],
            'status_by' => ['nullable', 'integer', 'exists:users,id'],
            'status_note' => ['nullable', 'string'],
        ];
    }

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'competence_id.exists' => 'The selected competence does not exist.',
            'user_id.required' => 'A user is required.',
            'user_id.exists' => 'The selected user does not exist.',
            'language_id.required' => 'A language is required.',
            'language_id.exists' => 'The selected language does not exist.',
            'name.required' => 'A name is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'body.required' => 'Content is required.',
            // Add more as needed
        ];
    }
}
