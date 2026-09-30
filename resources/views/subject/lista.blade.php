<x-app-layout title="Matérias">
<x-slot name="header"><div class="d-flex justify-content-between align-items-center flex-wrap"><div><h2 class="sf-title">Matérias</h2><p class="sf-subtitle mb-0">Abra uma matéria para ver e cadastrar seus conteúdos.</p></div><a href="{{ route('subject.create') }}" class="sf-btn">+ Nova matéria</a></div></x-slot>
<div class="sf-card">
<form method="GET" action="{{ route('subject.search') }}" class="form-row mb-4">
<div class="col-md-10 mb-2"><input class="form-control" name="filtro" value="{{ $filtro ?? '' }}" placeholder="Pesquisar matéria..."></div>
<div class="col-md-2 mb-2"><button class="btn sf-btn btn-block">Pesquisar</button></div></form>
<div class="table-responsive"><table class="table sf-table">
<thead><tr><th class="text-center">Concluída</th><th>Matéria</th><th>Descrição</th><th>Conteúdos</th><th>Progresso</th><th>Ações</th></tr></thead><tbody>
@forelse($subjects as $subject)
@php $total=$subject->contents->count(); $done=$subject->contents->where('status',true)->count(); $p=$total?round($done/$total*100):0; @endphp
<tr>
<td class="text-center">
<form method="POST" action="{{ route('subject.toggle',$subject->id) }}" class="m-0">@csrf
<input type="hidden" name="status" value="0">
<input type="checkbox" name="status" value="1" style="width:18px;height:18px;cursor:pointer" title="Marcar matéria como concluída" onchange="this.form.submit()" @checked($subject->status)>
</form></td>
<td><a href="{{ route('subject.show',$subject->id) }}" style="color:#464649;{{ $subject->status ? 'text-decoration:line-through;opacity:.6' : '' }}"><strong>{{ $subject->name }}</strong></a></td>
<td>{{ $subject->description ?: '—' }}</td>
<td>{{ $done }}/{{ $total }}</td>
<td style="min-width:150px"><small>{{ $p }}%</small><div class="progress"><div class="progress-bar" style="width:{{ $p }}%;background:#464649"></div></div></td>
<td class="text-nowrap"><a href="{{ route('subject.show',$subject->id) }}" class="btn btn-sm sf-btn">Abrir</a> <a href="{{ route('subject.view',$subject->id) }}" class="btn btn-sm sf-btn-outline">Editar</a> <a href="{{ route('subject.destroy',$subject->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir esta matéria e seus conteúdos?')">Excluir</a></td></tr>
@empty<tr><td colspan="6" class="text-center py-4">Nenhuma matéria cadastrada.</td></tr>@endforelse
</tbody></table></div></div>
</x-app-layout>
