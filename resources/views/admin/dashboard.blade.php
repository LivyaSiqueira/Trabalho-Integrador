<x-app-layout title="Painel do administrador">
    <x-slot name="header">
        <h2 class="sf-title">Painel do administrador</h2>
        <p class="sf-subtitle mb-0">Visão geral do StudyFY e controle de usuários</p>
    </x-slot>

    <div class="row">
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="sf-card sf-stat">
                <small>Usuários</small>
                <h2>{{ $totalUsers }}</h2>
                <span class="text-muted">{{ $newUsers }} novo(s) nos últimos 7 dias</span>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="sf-card sf-stat">
                <small>Matérias</small>
                <h2>{{ $totalSubjects }}</h2>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="sf-card sf-stat">
                <small>Conteúdos</small>
                <h2>{{ $totalContents }}</h2>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="sf-card sf-stat">
                <small>Progresso geral</small>
                <h2>{{ $progress }}%</h2>
                <div class="progress"><div class="progress-bar" style="width:{{ $progress }}%;background:#464649"></div></div>
            </div>
        </div>
    </div>

    <div class="sf-card" id="usuarios">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
            <div>
                <h4 class="sf-title mb-1">Usuários cadastrados</h4>
                <span class="text-muted">{{ $users->total() }} encontrado(s)</span>
            </div>
            <a href="{{ route('admin.users.create') }}" class="sf-btn mt-2 mt-md-0">+ Novo usuário</a>
        </div>

        <form method="GET" action="{{ route('admin.dashboard') }}#usuarios" class="mb-4">
            <div class="input-group">
                <input type="text" name="q" value="{{ $search }}" class="form-control" placeholder="Pesquisar por nome ou e-mail">
                <div class="input-group-append">
                    <button type="submit" class="sf-btn">Buscar</button>
                    @if($search !== '')
                        <a href="{{ route('admin.dashboard') }}#usuarios" class="sf-btn-outline ml-2">Limpar</a>
                    @endif
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table sf-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th class="text-center">Matérias</th>
                        <th class="text-center">Conteúdos</th>
                        <th style="min-width:140px">Progresso</th>
                        <th>Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        @php $p = $user->contents_count ? round($user->done_contents_count / $user->contents_count * 100) : 0; @endphp
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center">{{ $user->subjects_count }}</td>
                            <td class="text-center">{{ $user->contents_count }}</td>
                            <td>
                                <div class="progress"><div class="progress-bar" style="width:{{ $p }}%;background:#464649"></div></div>
                                <small>{{ $p }}%</small>
                            </td>
                            <td>{{ $user->created_at?->format('d/m/Y') ?? '—' }}</td>
                            <td class="text-right text-nowrap">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius:20px">Editar</a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="d-inline"
                                      onsubmit="return confirm('Excluir {{ e($user->name) }}? As matérias e conteúdos dele também serão removidos.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:20px">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Nenhum usuário encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="mt-3">
                {{ $users->fragment('usuarios')->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
