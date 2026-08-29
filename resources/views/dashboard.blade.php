<x-app-layout>
    <x-slot name="header">
        <h2 class="sf-title">Olá, {{ Auth::user()->name }}! 👋</h2>
        <p class="sf-subtitle mb-0">Organize seus estudos e acompanhe seu progresso.</p>
    </x-slot>

    @php
        $subjects = Auth::user()->subjects()->with('contents')->get();
        $totalContents = $subjects->sum(fn($s) => $s->contents->count());
        $doneContents = $subjects->sum(fn($s) => $s->contents->where('status', true)->count());
        $progress = $totalContents ? round(($doneContents / $totalContents) * 100) : 0;
    @endphp

    <div class="row">
        @if(Auth::user()->email === config('auth.admin.email'))
            <div class="col-md-4 mb-4">
                <div class="sf-card sf-stat">
                    <small>Controle</small>
                    <h2>Usuários</h2>
                    <a href="{{ route('admin.users.index') }}">Gerenciar usuários →</a>
                </div>
            </div>
        @endif
        <div class="col-md-4 mb-4"><div class="sf-card sf-stat"><small>Matérias</small><h2>{{ $subjects->count() }}</h2><a href="{{ route('subject.index') }}">Gerenciar matérias →</a></div></div>
        <div class="col-md-4 mb-4"><div class="sf-card sf-stat"><small>Conteúdos</small><h2>{{ $totalContents }}</h2><a href="{{ route('content.index') }}">Gerenciar conteúdos →</a></div></div>
        <div class="col-md-4 mb-4"><div class="sf-card sf-stat"><small>Progresso geral</small><h2>{{ $progress }}%</h2><div class="progress"><div class="progress-bar" style="width:{{ $progress }}%;background:#464649"></div></div></div></div>
    </div>

    <div class="sf-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div><h3 class="sf-title">Seu perfil de estudos</h3><p class="mb-0">{{ Auth::user()->email }}</p></div>
            <a href="{{ route('profile.edit') }}" class="sf-btn">Editar perfil</a>
        </div>
        @if($subjects->isEmpty())
            <p>Você ainda não cadastrou nenhuma matéria.</p>
            <a href="{{ route('subject.create') }}" class="sf-btn">+ Criar primeira matéria</a>
        @else
            <div class="row">
                @foreach($subjects as $subject)
                    @php $count=$subject->contents->count(); $done=$subject->contents->where('status',true)->count(); $p=$count?round($done/$count*100):0; @endphp
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3">
                            <div class="d-flex justify-content-between"><strong>{{ $subject->name }}</strong><span>{{ $p }}%</span></div>
                            <small>{{ $done }}/{{ $count }} conteúdos concluídos</small>
                            <div class="progress mt-2"><div class="progress-bar" style="width:{{ $p }}%;background:#464649"></div></div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>