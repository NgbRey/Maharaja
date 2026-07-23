<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CatalogProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && (bool) auth()->user()->is_admin;
    }

    public function rules(): array
    {
        $id = $this->route('catalog')?->id ?? $this->route('catalog_product')?->id;

        return [
            'category'  => ['required', Rule::in(['games','pulsa','lainnya'])],
            'name'      => ['required','string','max:150',
                Rule::unique('catalog_products','name')->ignore($id)->where(fn($q)=>$q->where('category',$this->category))],
            'developer' => ['nullable','string','max:120'],
            'image'     => [$id ? 'nullable' : 'required','image','max:3072'],
            'is_active' => ['nullable','boolean'],
            'sort'      => ['nullable','integer','min:0'],
        ];
    }
}
