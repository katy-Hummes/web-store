<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestProduct extends FormRequest
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            // 'photos' => 'required|array',
            // 'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    
    public function messages(): array
    {
        return [
            'required' => 'O campo é obrigatório',
            'string' => 'O campo deve ser uma string',
            'max' => 'O campo deve ter no máximo 255 caracteres',
            'numeric' => 'O campo deve ser um número',
            'photos.*.image' => 'O arquivo deve ser uma imagem',
            'photos.*.mimes' => 'O arquivo deve ser uma imagem',
            'photos.*.max' => 'O arquivo deve ter no máximo 2MB',
        ];
    }

}
