<x-app-layout>
<x-slot name="header"><h2 class="sf-title">Novo conteúdo</h2></x-slot>
<div class="row justify-content-center"><div class="col-lg-7"><div class="sf-card">
@if($subjects->isEmpty())<div class="alert alert-info">Cadastre uma matéria primeiro. <a href="{{ route('subject.create') }}">Criar matéria</a></div>@else
<form method="POST" action="{{ route('content.store') }}">@csrf
<div class="form-group"><label>Matéria</label><select name="subjects_id" class="form-control" required>@foreach($subjects as $subject)<option value="{{ $subject->id }}">{{ $subject->name }}</option>@endforeach</select></div>
<div class="form-group"><label>Título</label><input name="title" value="{{ old('title') }}" class="form-control" required></div>
<div class="form-group"><label>Descrição</label><textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea></div>
<div class="form-check mb-4"><input id="status" name="status" value="1" type="checkbox" class="form-check-input"><label for="status" class="form-check-label">Já concluído</label></div>
<button class="sf-btn">Salvar conteúdo</button> <a href="{{ route('content.index') }}" class="sf-btn-outline">Cancelar</a>
</form>@endif
</div></div></div>
</x-app-layout>