<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
    return auth()->check() && (bool) auth()->user()->is_admin;
    }
    
    public function rules(): array {
        return [
            'title'      => ['nullable','string','max:120'],
            'image'      => [$this->banner ? 'nullable' : 'required','image','max:3072'], // jpg/png/webp <=3MB
            'link_url'   => ['nullable','url'],
            'is_active'  => ['nullable','boolean'],
            'sort'       => ['nullable','integer','min:0'],
        ];
    }
}
