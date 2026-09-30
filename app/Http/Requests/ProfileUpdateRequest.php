<?php

namespace App\Http\Requests;

use App\Models\User;
use Closure;
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
        $isAdmin = $this->user()->isAdmin();

        // Nome/e-mail do administrador ficam reservados para ele.
        $notReserved = fn (string $message) => function (string $attribute, mixed $value, Closure $fail) use ($isAdmin, $message) {
            if (! $isAdmin && User::isReservedForAdmin((string) $value)) {
                $fail($message);
            }
        };

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'not_regex:/@/',
                Rule::unique(User::class, 'name')->ignore($this->user()->id),
                $notReserved('Esse nome não está disponível.'),
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
                $notReserved('Esse e-mail não está disponível.'),
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.unique' => 'Já existe um usuário com esse nome. Escolha outro.',
            'name.not_regex' => 'O nome não pode conter o caractere "@".',
        ];
    }
}
