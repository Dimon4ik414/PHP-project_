<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route('category')->id;

        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:categories,slug,' . $categoryId,
            'description' => 'nullable|string',
            'color' => 'nullable|string',
            'sort_order' => 'nullable|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название категории обязательно',
            'slug.required' => 'Slug обязателен',
            'slug.unique' => 'Такой slug уже существует'
        ];
    }
}
