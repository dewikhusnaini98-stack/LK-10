<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'publisher' => 'required|max:255',
            'year' => 'required|numeric',
            'category' => 'required|max:255',
            'description' => 'required',
            'cover' => $this->isMethod('POST') 
                ? 'required|image|mimes:jpg,jpeg,png|max:2048'
                : 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }
}
