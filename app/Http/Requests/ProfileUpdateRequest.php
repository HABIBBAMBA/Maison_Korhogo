<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->user();

        $rules = [
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user?->id),
            ],
            'name' => ['nullable', 'string', 'max:255'],
        ];

        if ($user) {
            if ($user->role === 'client') {
                $rules['nom'] = ['nullable', 'string', 'max:255'];
                $rules['prenom'] = ['nullable', 'string', 'max:255'];
                $rules['telephone'] = ['nullable', 'string', 'max:50'];
            } elseif ($user->role === 'proprietaire') {
                $rules['nom'] = ['nullable', 'string', 'max:255'];
                $rules['prenom'] = ['nullable', 'string', 'max:255'];
                $rules['telephone'] = ['nullable', 'string', 'max:50'];
                $rules['adresse'] = ['nullable', 'string', 'max:255'];
            } elseif ($user->role === 'agence') {
                $rules['nom_agence'] = ['nullable', 'string', 'max:255'];
                $rules['nom_responsable'] = ['nullable', 'string', 'max:255'];
                $rules['telephone'] = ['nullable', 'string', 'max:50'];
                $rules['adresse'] = ['nullable', 'string', 'max:255'];
                $rules['logo'] = ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'];
            }
        }

        return $rules;
    }

    /**
     * Custom error messages in French.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'Veuillez saisir une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée par un autre compte.',
            'logo.image' => 'Le fichier doit être une image valide.',
            'logo.mimes' => 'Le logo doit être au format JPG, PNG ou WebP.',
            'logo.max' => 'Le logo ne doit pas dépasser 2 Mo.',
        ];
    }
}
