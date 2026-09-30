<x-app-layout title="Novo conteúdo">
<x-slot name="header"><a href="{{ route('subject.show',$subject->id) }}" style="color:#7A7A7C">← {{ $subject->name }}</a><h2 class="sf-title mt-2">Novo conteúdo</h2><p class="sf-subtitle mb-0">Matéria: {{ $subject->name }}</p></x-slot>
<div class="row justify-content-center"><div class="col-lg-7"><div class="sf-card">
<form method="POST" action="{{ route('content.store',$subject->id) }}">@csrf
<div class="form-group"><label>Título</label><input name="title" value="{{ old('title') }}" class="form-control" required autofocus>@error('title')<small class="text-danger">{{ $message }}</small>@enderror</div>
<div class="form-group"><label>Descrição</label><textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea></div>
<div class="form-check mb-4"><input id="status" name="status" value="1" type="checkbox" class="form-check-input" @checked(old('status'))><label for="status" class="form-check-label">Concluído</label></div>
<button class="sf-btn">Salvar conteúdo</button> <a href="{{ route('subject.show',$subject->id) }}" class="sf-btn-outline">Cancelar</a>
</form>
</div></div></div>
</x-app-layout>
