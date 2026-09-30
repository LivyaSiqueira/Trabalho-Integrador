@php $p = $total ? round($done / $total * 100) : 0; @endphp
<x-app-layout :title="'Conteúdos - '.$subject->name">
<x-slot name="header">
<a href="{{ route('subject.index') }}" style="color:#7A7A7C">← Matérias</a>
<div class="d-flex justify-content-between align-items-center flex-wrap mt-2">
<div>
<h2 class="sf-title mb-1">{{ $subject->name }}</h2>
<p class="sf-subtitle mb-0">{{ $subject->description ?: 'Conteúdos desta matéria.' }}</p>
</div>
<div class="mt-2 mt-md-0">
<a href="{{ route('subject.view',$subject->id) }}" class="sf-btn-outline mr-2">Editar matéria</a>
<a href="{{ route('content.create',$subject->id) }}" class="sf-btn">+ Novo conteúdo</a>
</div>
</div>
</x-slot>

<div class="sf-card mb-4">
<div class="d-flex justify-content-between align-items-center flex-wrap">
<div style="flex:1;min-width:220px" class="mr-4">
<small>Progresso da matéria — {{ $done }}/{{ $total }} conteúdos concluídos ({{ $p }}%)</small>
<div class="progress mt-1"><div class="progress-bar" style="width:{{ $p }}%;background:#464649"></div></div>
</div>
<form method="POST" action="{{ route('subject.toggle',$subject->id) }}" class="m-0 mt-3 mt-md-0">@csrf
<input type="hidden" name="status" value="0">
<label class="mb-0" style="cursor:pointer"><input type="checkbox" name="status" value="1" class="mr-2" style="width:18px;height:18px;vertical-align:middle" onchange="this.form.submit()" @checked($subject->status)> Matéria concluída</label>
</form>
</div>
</div>

<div class="sf-card">
<form method="GET" action="{{ route('subject.show',$subject->id) }}" class="form-row mb-4">
<div class="col-md-10 mb-2"><input name="filtro" value="{{ $filtro }}" class="form-control" placeholder="Pesquisar conteúdo desta matéria..."></div>
<div class="col-md-2 mb-2"><button class="btn sf-btn btn-block">Pesquisar</button></div>
</form>
<div class="table-responsive"><table class="table sf-table">
<thead><tr><th class="text-center">Concluído</th><th>Título</th><th>Descrição</th><th>Ações</th></tr></thead><tbody>
@forelse($contents as $content)
<tr>
<td class="text-center">
<form method="POST" action="{{ route('content.toggle',$content->id) }}" class="m-0">@csrf
<input type="hidden" name="status" value="0">
<input type="checkbox" name="status" value="1" style="width:18px;height:18px;cursor:pointer" title="Marcar conteúdo como concluído" onchange="this.form.submit()" @checked($content->status)>
</form></td>
<td><strong style="{{ $content->status ? 'text-decoration:line-through;opacity:.6' : '' }}">{{ $content->title }}</strong></td>
<td>{{ $content->description ?: '—' }}</td>
<td class="text-nowrap"><a href="{{ route('content.view',$content->id) }}" class="btn btn-sm sf-btn-outline">Editar</a> <a href="{{ route('content.destroy',$content->id) }}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Excluir este conteúdo?')">Excluir</a></td>
</tr>
@empty
<tr><td colspan="4" class="text-center py-4">{{ $filtro !== '' ? 'Nenhum conteúdo encontrado.' : 'Nenhum conteúdo cadastrado nesta matéria.' }}</td></tr>
@endforelse
</tbody></table></div>
</div>
</x-app-layout>
