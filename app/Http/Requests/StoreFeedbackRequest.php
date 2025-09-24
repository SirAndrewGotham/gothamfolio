<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'language_id' => 'nullable',
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|max:500',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'language_id' => (int) Language::query()->where('code', app()->getLocale())->first()->id,
        ]);
    }
}
