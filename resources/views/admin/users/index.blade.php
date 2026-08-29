<x-app-layout>
    <x-slot name="header">
        <h2 class="sf-title">Controle de usuários</h2>
        <p class="sf-subtitle mb-0">Lista e pesquisa de usuários do sistema.</p>
    </x-slot>

    <div class="sf-card">
        <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Pesquisar por nome ou e-mail">
                <div class="input-group-append">
                    <button type="submit" class="sf-btn">Buscar</button>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table sf-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->email === config('auth.admin.email'))
                                    <span class="badge badge-dark">Administrador</span>
                                @else
                                    <span class="badge badge-secondary">Usuário</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Nenhum usuário encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="mt-3">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
