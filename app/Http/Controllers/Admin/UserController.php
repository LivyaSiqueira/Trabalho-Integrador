<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    public function create(): View
    {
        return view('admin.users.form', ['user' => new User()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        $user = new User(['name' => $data['name'], 'email' => $data['email'], 'password' => $data['password']]);
        $user->email_verified_at = now();
        $user->save();

        return $this->backToList('Usuário criado com sucesso!');
    }

    public function edit(int $id): View
    {
        return view('admin.users.form', ['user' => User::students()->findOrFail($id)]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $user = User::students()->findOrFail($id);
        $data = $this->validated($request, $user);

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (! empty($data['password'])) {
            $user->password = $data['password'];
        }

        $user->save();

        return $this->backToList('Usuário atualizado com sucesso!');
    }

    public function destroy(int $id): RedirectResponse
    {
        User::students()->findOrFail($id)->delete();

        return $this->backToList('Usuário excluído com sucesso!');
    }

    private function backToList(string $message): RedirectResponse
    {
        return redirect()->to(route('admin.dashboard').'#usuarios')->with('msg', $message);
    }

    private function validated(Request $request, ?User $user = null): array
    {
        $request->merge(['email' => Str::lower((string) $request->input('email'))]);

        $notReserved = fn (string $message) => function (string $attribute, mixed $value, Closure $fail) use ($message) {
            if (User::isReservedForAdmin((string) $value)) {
                $fail($message);
            }
        };

        return $request->validate([
            'name' => [
                'required', 'string', 'max:255', 'not_regex:/@/',
                Rule::unique(User::class, 'name')->ignore($user?->id),
                $notReserved('Esse nome não está disponível.'),
            ],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique(User::class, 'email')->ignore($user?->id),
                $notReserved('Esse e-mail não está disponível.'),
            ],
            'password' => [$user ? 'nullable' : 'required', 'confirmed', Password::defaults()],
        ], [
            'name.unique' => 'Já existe um usuário com esse nome. Escolha outro.',
            'name.not_regex' => 'O nome não pode conter o caractere "@".',
            'email.unique' => 'Já existe um usuário com esse e-mail.',
        ]);
    }
}
