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
 * @property \App\Enums\PostStatus $status
 * @property int|null $status_by
 * @property string|null $status_note
 */
class UpdatePostTranslationRequest extends FormRequest
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
            'language_id' => 'required|integer|exists:languages,id',
            'title' => 'required|string',
            'excerpt' => 'nullable|string',
            'body' => 'required',
            'order' => 'nullable',
            'published_at' => 'nullable|date',
            'published_through' => 'nullable|date',
            'tags' => 'nullable',
            'image' => 'nullable',
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
        if ($this->input('excerpt') === null) {
            $this->merge(['excerpt' => Str::limit($this->input('body'), 50, preserveWords: true)]);
        }

        $data = [
            'user_id' => $this->user_id ?? auth()->id(),
            'order' => $this->order ?? 0,
        ];
        // Decrypt only when fields are present
        if ($this->filled('post_id')) {
            try {
                $data['post_id'] = Crypt::decryptString((string) $this->post_id);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'post_id' => 'Invalid encrypted input.',
                ]);
            }
        } else {
            $data['post_id'] = null;
        }

        if ($this->filled('language')) {
            try {
                $data['language_id'] = (int) Crypt::decryptString((string) $this->language);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    'language' => 'Invalid encrypted input.',
                ]);
            }
        }

        $this->merge([
            'post_id' => $this->post_id ? Crypt::decryptString($this->post_id) : null,
            'user_id' => $this->user_id ?? auth()->id(),
            'language_id' => (int) Crypt::decryptString($this->language),
            'order' => $this->order ?? 0,
        ]);
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'language_id.required' => 'Please choose a language.',
            'language_id.exists' => 'The selected language is invalid.',
            'post_id.exists' => 'The selected post is invalid.',
            'status.*' => 'The provided status value is invalid.',
        ];
    }
}
