<?php

namespace App\Http\Requests;

use App\Enums\PostStatus;
use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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

    protected function prepareForValidation(): void
    {
        if($this->input('excerpt') == null )
        {
            $this->merge(['excerpt' => Str::limit($this->input('body'), 50, preserveWords: true)]);
        }
        $this->merge([
            'post_id' => Crypt::decrypt($this->post_id),
            'user_id' => $this->user_id ?? auth()->id(),
            'language_id' => (int) Crypt::decrypt($this->language),
            'order' => $this->order ?? 0,
        ]);
    }
}
