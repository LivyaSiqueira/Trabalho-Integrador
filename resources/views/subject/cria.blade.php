<x-app-layout title="Nova matéria">
<x-slot name="header"><h2 class="sf-title">Nova matéria</h2></x-slot>
<div class="row justify-content-center"><div class="col-lg-7"><div class="sf-card">
<form method="POST" action="{{ route('subject.store') }}">@csrf
<div class="form-group"><label>Nome</label><input name="name" value="{{ old('name') }}" class="form-control" required>@error('name')<small class="text-danger">{{ $message }}</small>@enderror</div>
<div class="form-group"><label>Descrição</label><textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea></div>
<div class="form-check mb-4"><input id="status" name="status" value="1" type="checkbox" class="form-check-input" @checked(old('status'))><label for="status" class="form-check-label">Matéria concluída</label></div>
<button class="sf-btn">Salvar matéria</button> <a href="{{ route('subject.index') }}" class="sf-btn-outline">Cancelar</a>
</form></div></div></div>
</x-app-layout>
