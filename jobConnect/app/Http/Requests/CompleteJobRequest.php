<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompleteJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        // L'autorisation métier (policy) est vérifiée dans le controller,
        // ici on laisse passer — Sanctum garantit déjà que l'utilisateur est authentifié.
        return true;
    }

    public function rules(): array
    {
        return [
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'notes.max' => 'Les notes ne doivent pas dépasser 1000 caractères.',
        ];
    }
}
