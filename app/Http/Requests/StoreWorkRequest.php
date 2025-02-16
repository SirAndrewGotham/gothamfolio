<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreWorkRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'language_id' => 'required|integer|exists:languages,id',
            'title' => 'required|string',
            'excerpt' => 'nullable|string',
            'content' => 'required',
            'order' => 'nullable',
            'published_at' => 'nullable|date',
//            'published_at' => 'nullable|date|date_format:Y-m-d H:i:s'
            'tags' => 'nullable',
            'image' => 'nullable',
        ];
    }

    protected function prepareForValidation() {
        if($this->input('excerpt') == null )
        {
            $this->merge(['excerpt' => Str::limit($this->input('content'), 50, preserveWords: true)]);
        }
        $this->merge([
            'user_id' => $this->user_id ?? auth()->id(),
            'language_id' => (int)Language::where('code', $this->language)->first()->id,
            'order' => $this->order ?? 0,
        ]);
    }
}
