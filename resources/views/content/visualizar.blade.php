<x-app-layout>
<x-slot name="header"><h2 class="sf-title">Editar conteúdo</h2></x-slot>
<div class="row justify-content-center"><div class="col-lg-7"><div class="sf-card">
<form method="POST" action="{{ route('content.update',$content->id) }}">@csrf
<div class="form-group"><label>Matéria</label><select name="subjects_id" class="form-control" required>@foreach($subjects as $subject)<option value="{{ $subject->id }}" @selected(old('subjects_id',$content->subjects_id)==$subject->id)>{{ $subject->name }}</option>@endforeach</select></div>
<div class="form-group"><label>Título</label><input name="title" value="{{ old('title',$content->title) }}" class="form-control" required></div>
<div class="form-group"><label>Descrição</label><textarea name="description" class="form-control" rows="4">{{ old('description',$content->description) }}</textarea></div>
<div class="form-check mb-4"><input id="status" name="status" value="1" type="checkbox" class="form-check-input" @checked(old('status',$content->status))><label for="status" class="form-check-label">Concluído</label></div>
<button class="sf-btn">Atualizar</button> <a href="{{ route('content.index') }}" class="sf-btn-outline">Cancelar</a>
</form></div></div></div>
</x-app-layout>