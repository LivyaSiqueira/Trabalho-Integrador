@php $editing = $user->exists; @endphp
<x-app-layout :title="$editing ? 'Editar usuário' : 'Novo usuário'">
    <x-slot name="header">
        <h2 class="sf-title">{{ $editing ? 'Editar usuário' : 'Novo usuário' }}</h2>
        <p class="sf-subtitle mb-0">{{ $editing ? 'Altere os dados do usuário. Deixe a senha em branco para mantê-la.' : 'Preencha os dados para cadastrar um usuário.' }}</p>
    </x-slot>

    <div class="sf-card" style="max-width:640px">
        <form method="POST" action="{{ $editing ? route('admin.users.update', $user->id) : route('admin.users.store') }}">
            @csrf
            @if($editing) @method('PUT') @endif

            <div class="form-group">
                <label>Nome de usuário</label>
                <input name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" required autofocus>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>{{ $editing ? 'Nova senha (opcional)' : 'Senha' }}</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password" @if(! $editing) required @endif>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Confirmar senha</label>
                <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password" @if(! $editing) required @endif>
            </div>

            <button type="submit" class="sf-btn">{{ $editing ? 'Salvar alterações' : 'Criar usuário' }}</button>
            <a href="{{ route('admin.dashboard') }}#usuarios" class="sf-btn-outline ml-2">Cancelar</a>
        </form>
    </div>
</x-app-layout>
