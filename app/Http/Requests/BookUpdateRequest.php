<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BookUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|max:255',
            'author' => 'string',
            'date_published' => 'date',
            'publisher' => 'string',
            'description' => 'string',
            'price' => 'integer|min:0',
            'page_count' => 'integer|min:0',
            'cover' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery' => 'array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }
}
