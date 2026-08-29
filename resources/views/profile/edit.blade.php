<x-app-layout>
<x-slot name="header"><h2 class="sf-title">Meu perfil</h2><p class="sf-subtitle mb-0">Seus dados e seu progresso ficam reunidos aqui.</p></x-slot>
<div class="row">
<div class="col-lg-4 mb-4"><div class="sf-card text-center">
<div style="width:100px;height:100px;border-radius:50%;background:#464649;color:#fff;font-size:40px;display:flex;align-items:center;justify-content:center;margin:0 auto 18px">{{ strtoupper(substr($user->name,0,1)) }}</div>
<h3>{{ $user->name }}</h3><p class="text-muted">{{ $user->email }}</p>
@php $subjectCount=$user->subjects()->count(); $contentCount=$user->subjects()->withCount('contents')->get()->sum('contents_count'); $doneCount=$user->subjects()->with('contents')->get()->sum(fn($s)=>$s->contents->where('status',true)->count()); @endphp
<div class="row mt-4"><div class="col-4"><strong>{{ $subjectCount }}</strong><small class="d-block">Matérias</small></div><div class="col-4"><strong>{{ $contentCount }}</strong><small class="d-block">Conteúdos</small></div><div class="col-4"><strong>{{ $contentCount ? round($doneCount/$contentCount*100) : 0 }}%</strong><small class="d-block">Progresso</small></div></div>
</div></div>
<div class="col-lg-8">
<div class="sf-card mb-4"><h4 class="sf-title">Dados da conta</h4>
<form method="POST" action="{{ route('profile.update') }}">@csrf @method('PATCH')
<div class="form-group"><label>Nome</label><input name="name" value="{{ old('name',$user->name) }}" class="form-control" required></div>
<div class="form-group"><label>E-mail</label><input type="email" name="email" value="{{ old('email',$user->email) }}" class="form-control" required></div>
<button class="sf-btn">Salvar alterações</button>
</form></div>
<div class="sf-card mb-4"><h4 class="sf-title">Alterar senha</h4>
<form method="POST" action="{{ route('password.update') }}">@csrf @method('PUT')
<div class="form-group"><label>Senha atual</label><input type="password" name="current_password" class="form-control" required></div>
<div class="form-group"><label>Nova senha</label><input type="password" name="password" class="form-control" required></div>
<div class="form-group"><label>Confirmar nova senha</label><input type="password" name="password_confirmation" class="form-control" required></div>
<button class="sf-btn">Atualizar senha</button>
</form></div>
<div class="sf-card border-danger"><h4 class="text-danger">Excluir conta</h4><p>Essa ação remove seu usuário, matérias e conteúdos.</p>
<form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.')">@csrf @method('DELETE')
<input type="password" name="password" class="form-control mb-3" placeholder="Digite sua senha para confirmar" required>
<button class="btn btn-danger" style="border-radius:24px">Excluir minha conta</button>
</form></div>
</div></div>
</x-app-layout>