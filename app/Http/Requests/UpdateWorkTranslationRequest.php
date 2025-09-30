<?php

namespace App\Http\Requests;

use App\Enums\WorkStatus;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * @property int $work_id
 * @property int $user_id
 * @property int $language_id
 * @property string $title
 * @property string|null $excerpt
 * @property string $body
 * @property mixed|null $image
 * @property mixed|null $link
 * @property string|null $published_at
 * @property string|null $published_through
 * @property int|null $order
 * @property \App\Enums\WorkStatus $status
 * @property int|null $status_by
 * @property string|null $status_note
 * @property int|null $views
 * @property mixed|null $tags
 */
class UpdateWorkTranslationRequest extends FormRequest
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
            'work_id' => 'required|exists:works,id',
            'user_id' => 'required|exists:users,id',
            'language_id' => 'required|integer|exists:languages,id',
            'title' => 'required|string',
            'excerpt' => 'nullable|string',
            'body' => 'required',
            'image' => 'nullable',
            'link' => 'nullable',
            'published_at' => 'nullable|date',
            'published_through' => 'nullable|date',
            //            'published_at' => 'nullable|date|date_format:Y-m-d H:i:s'
            'order' => 'nullable|integer',
            'status' => [Rule::enum(WorkStatus::class)],
            'status_by' => 'nullable|exists:users,id',
            'status_note' => 'nullable|string',
            'views' => 'nullable|integer',
            'tags' => 'nullable',
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

        try {
            $workId = Crypt::decryptString($this->work_id);
            $languageId = (int) Crypt::decryptString($this->language);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(400,
                'Invalid encrypted input');
        }

        $this->merge([
            'work_id' => Crypt::decryptString($this->work_id),
            'user_id' => $this->user_id ?? auth()->id(),
            'language_id' => (int) Crypt::decryptString($this->language),
            'order' => $this->order ?? 0,
        ]);
    }
}
