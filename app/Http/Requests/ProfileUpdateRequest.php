<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
   public function rules(): array
{
    $userId = $this->user()->id;

    return [
        'name' => ['required', 'string', 'max:255'],
        'display_name' => ['nullable', 'string', 'max:255'],
        'bio' => ['nullable', 'string', 'max:500'],
        'avatar' => ['nullable', 'image', 'max:2048'], // foto profil
        'instagram' => ['nullable', 'url', 'max:255'],
        'behance' => ['nullable', 'url', 'max:255'],
        'website' => ['nullable', 'url', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $userId],
    ];

    }
}
