<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|string|min:8',
            'description' => 'required|string',
            'video' => 'required|mimes:mp4|max:10000',
            'images' => 'required|array|min:3|max:6',
            'images.*' => 'required|image|mimes:png,jpg|max:10000'
        ];
    }
}
