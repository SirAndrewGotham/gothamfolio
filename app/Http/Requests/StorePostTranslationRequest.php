<?php

namespace App\Http\Requests;

use App\Enums\PostStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
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
 * @property mixed|null $tags
 * @property mixed|null $image
 * @property \\App\\Enums\\PostStatus $status
 * @property int|null $status_by
 * @property string|null $status_note
 */
class StorePostTranslationRequest extends FormRequest
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
            'post_id' => 'nullable|integer|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'language_id' => 'required|integer|exists:languages,id',
            'title' => 'required|string',
            'excerpt' => 'nullable|string',
            'body' => 'required|string',
            'order' => 'nullable|integer|min:0',
            'published_at' => 'nullable|date',
            'published_through' => 'nullable|date',
            'tags' => 'nullable',
            'image' => 'nullable',
            'status' => ['nullable', Rule::enum(PostStatus::class)],
            'status_by' => 'nullable|exists:users,id',
            'status_note' => 'nullable|string',
            'language' => 'required|string',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->input('excerpt') === null) {
            $this->merge(['excerpt' => Str::limit($this->input('body'), 50, preserveWords: true)]);
        }
        $this->merge([
            'post_id' => Crypt::decryptString($this->post_id),
            'user_id' => $this->user_id ?? auth()->id(),
            'language_id' => (int) Crypt::decryptString($this->language),
            'order' => $this->order ?? 0,
        ]);
    }

    /*** Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The work title is required.',
            'translation_title.required' => 'The translation title is required.',
            'body.required' => 'The body content is required.',
            'language_id.required' => 'A language must be selected.',
            'language_id.exists' => 'The selected language is invalid.',
            'language.required' => 'A language must be selected.',
        ];
    }
}
