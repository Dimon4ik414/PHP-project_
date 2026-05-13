<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:255|min:3',
            'slug' => 'required|string|max:255|unique:categories,slug|regex:/^[a-z0-9-]+$/',
            'description' => 'nullable|string|max:1000',
            'color' => 'nullable|string|max:7|regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
            'sort_order' => 'nullable|integer|min:0|max:999'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [

            'name.required' => 'Поле "Название категории" обязательно для заполнения',
            'name.string' => 'Название должно быть строкой',
            'name.max' => 'Название не может превышать 255 символов',
            'name.min' => 'Название должно содержать минимум 3 символа',


            'slug.required' => 'Поле "Slug" обязательно для заполнения',
            'slug.string' => 'Slug должен быть строкой',
            'slug.max' => 'Slug не может превышать 255 символов',
            'slug.unique' => 'Такой slug уже существует. Пожалуйста, используйте другой',
            'slug.regex' => 'Slug может содержать только латинские буквы, цифры и дефис',


            'description.string' => 'Описание должно быть строкой',
            'description.max' => 'Описание не может превышать 1000 символов',


            'color.string' => 'Цвет должен быть строкой',
            'color.max' => 'Цвет не может превышать 7 символов',
            'color.regex' => 'Цвет должен быть в формате HEX (#RRGGBB или #RGB)',


            'sort_order.integer' => 'Порядок сортировки должен быть числом',
            'sort_order.min' => 'Порядок сортировки не может быть меньше 0',
            'sort_order.max' => 'Порядок сортировки не может быть больше 999'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if (empty($this->slug)) {
            $this->merge([
                'slug' => \Illuminate\Support\Str::slug($this->name)
            ]);
        }


        if ($this->color) {
            $this->merge([
                'color' => strtolower($this->color)
            ]);
        }
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'name' => 'название категории',
            'slug' => 'slug',
            'description' => 'описание',
            'color' => 'цвет',
            'sort_order' => 'порядок сортировки'
        ];
    }
}
