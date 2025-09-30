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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
