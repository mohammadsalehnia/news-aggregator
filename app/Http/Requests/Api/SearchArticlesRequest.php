<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SearchArticlesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'title' => 'nullable|string',

            'categories' => 'nullable|array',
            'categories.*' => 'nullable|string',

            'sources' => 'nullable|array',
            'sources.*' => 'nullable|string',

            'authors' => 'nullable|array',
            'authors.*' => 'nullable|string',

            'from_date' => 'nullable|date_format:Y-m-d',
            'to_date' => 'nullable|date_format:Y-m-d|after_or_equal:from_date',

        ];
    }
}
