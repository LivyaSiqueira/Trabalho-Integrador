<x-app-layout>
<x-slot name="header"><h2 class="sf-title">Editar matéria</h2></x-slot>
<div class="row justify-content-center"><div class="col-lg-7"><div class="sf-card">
<form method="POST" action="{{ route('subject.update',$subject->id) }}">@csrf
<div class="form-group"><label>Nome</label><input name="name" value="{{ old('name',$subject->name) }}" class="form-control" required></div>
<div class="form-group"><label>Descrição</label><textarea name="description" class="form-control" rows="4">{{ old('description',$subject->description) }}</textarea></div>
<button class="sf-btn">Atualizar</button> <a href="{{ route('subject.index') }}" class="sf-btn-outline">Cancelar</a>
</form></div></div></div>
</x-app-layout>