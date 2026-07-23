<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class CategoryRequest extends FormRequest
{
    public function authorize(): bool {
    return auth()->check() && (bool) auth()->user()->is_admin;
    }
    public function rules(): array {
        $id = $this->route('category')?->id;
        return [
            'name' => ['required','string','max:100','unique:categories,name,'.($id ?? 'null')],
            'is_active' => ['nullable','boolean'],
            'sort' => ['nullable','integer','min:0'],
        ];
    }
}

