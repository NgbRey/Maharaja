<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GameRequest extends FormRequest
{
    public function authorize(): bool {
    return auth()->check() && (bool) auth()->user()->is_admin;
    }
    public function rules(): array {
        $id = $this->route('game')?->id;
        return [
            'category_id' => ['nullable','exists:categories,id'],
            'name' => ['required','string','max:150',
                Rule::unique('games','name')->ignore($id)->where(fn($q)=>$q->where('category_id',$this->category_id))],
            'image' => ['nullable','image','max:2048'], // jpg/png/webp
            'is_active' => ['nullable','boolean'],
            'sort' => ['nullable','integer','min:0'],
        ];
    }
}
