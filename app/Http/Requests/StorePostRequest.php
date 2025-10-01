<?php

namespace App\Http\Requests;

use App\Enums\PostStatus;
use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;

/**
 * @property int|null $post_id
 * @property int $user_id
 * @property int $language_id
 * @property string $title
 * @property string|null $excerpt
 * @property string $body
 * @property int|null $order
 * @property string|null $published_at
 * @property string|null $published_through
 * @property string|null $language
 * @property mixed|null $tags
 * @property UploadedFile|string|null $image
 * @property PostStatus $status
 * @property int|null $status_by
 * @property string|null $status_note
 */
class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post_id' => 'nullable|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            // Either an id or a code may be provided; exists excludes soft-deleted rows.
            'language_id' => ['required_without:language', 'integer', Rule::exists('languages', 'id')->whereNull('deleted_at')],
            'language' => ['required_without:language_id', 'string', Rule::exists('languages', 'code')->whereNull('deleted_at')],
            'title' => 'required|string',
            'excerpt' => 'nullable|string',
            'body' => 'required|string',
            'order' => 'nullable|integer|min:0',
            'published_at' => 'nullable|date',
            'published_through' => 'nullable|date|after_or_equal:published_at',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
            'image' => 'nullable|image',
            'status' => [Rule::enum(PostStatus::class)],
            'status_by' => 'nullable|exists:users,id',
            'status_note' => 'nullable|string',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // In prepareForValidation(): always use the authenticated user
        // and avoid throwing a 404 on missing language code.
        $languageId = $this->filled('language_id')
            ? (int) $this->input('language_id')
            : Language::query()
                ->where('code', $this->input('language'))
                ->value('id');
        $this->merge([
            'user_id' => auth()->id(),
            'language_id' => $languageId,
            'order' => (int) ($this->input('order') ?? 0),
        ]);
    }

    /**
     * @return array<string,string>
     */
    public function messages(): array
    {
        return [
            'language_id.required_without' => 'Provide a language ID or a language code.',
            'language.required_without' => 'Provide a language code or a language ID.',
            'language_id.exists' => 'The selected language is invalid.',
            'language.exists' => 'The selected language is invalid.',
            'published_through.after_or_equal' => 'Publish end must be on or after publish start.',
        ];
    }
}
