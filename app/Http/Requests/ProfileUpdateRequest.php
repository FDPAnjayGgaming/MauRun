<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'nik' => ['nullable', 'string', 'size:16', Rule::unique(User::class)->ignore($this->user()->id)],
            'no_hp' => ['nullable', 'numeric', 'digits_between:10,13', Rule::unique(User::class)->ignore($this->user()->id)],
            'jenis_kelamin' => ['nullable', 'in:Laki-Laki,Perempuan'],
            'ukuran_jersey_default' => ['nullable', 'in:S,M,L,XL,XXL'],
            'golongan_darah_default' => ['nullable', 'in:A,B,AB,O'],
        ];
    }
}
