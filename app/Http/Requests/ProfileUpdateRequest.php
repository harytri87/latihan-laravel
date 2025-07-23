<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class ProfileUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:4', 'max:255'],
            'username' => ['required', 'min:4', 'max:50', Rule::unique(User::class)->ignore($this->user()->id)],
            'password' => ['nullable', 'confirmed', Password::min(6)],
            'picture' => ['nullable', File::types(['png', 'jpg', 'webp'])->max(5 * 1024)],
        ];
    }
}
