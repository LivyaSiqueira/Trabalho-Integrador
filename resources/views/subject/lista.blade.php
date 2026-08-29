<x-app-layout>
<x-slot name="header"><div class="d-flex justify-content-between align-items-center"><div><h2 class="sf-title">Matérias</h2><p class="sf-subtitle mb-0">Cadastre e organize suas disciplinas.</p></div><a href="{{ route('subject.create') }}" class="sf-btn">+ Nova matéria</a></div></x-slot>
<div class="sf-card">
<form method="GET" action="{{ route('subject.search') }}" class="form-row mb-4">
<div class="col-md-10 mb-2"><input class="form-control" name="filtro" value="{{ $filtro ?? '' }}" placeholder="Pesquisar matéria..."></div>
<div class="col-md-2 mb-2"><button class="btn sf-btn btn-block">Pesquisar</button></div></form>
<div class="table-responsive"><table class="table sf-table">
<thead><tr><th>Matéria</th><th>Descrição</th><th>Progresso</th><th>Ações</th></tr></thead><tbody>
@forelse($subjects as $subject)
@php $total=$subject->contents()->count(); $done=$subject->contents()->where('status',true)->count(); $p=$total?round($done/$total*100):0; @endphp
<tr><td><strong>{{ $subject->name }}</strong></td><td>{{ $subject->description ?: '—' }}</td><td style="min-width:150px"><small>{{ $p }}%</small><div class="progress"><div class="progress-bar" style="width:{{ $p }}%;background:#464649"></div></div></td>
<td class="text-nowrap"><a href="{{ route('subject.view',$subject->id) }}" class="btn btn-sm sf-btn-outline">Editar</a> <a href="{{ route('subject.destroy',$subject->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir esta matéria e seus conteúdos?')">Excluir</a></td></tr>
@empty<tr><td colspan="4" class="text-center py-4">Nenhuma matéria cadastrada.</td></tr>@endforelse
</tbody></table></div></div>
</x-app-layout>