<?php
namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    private function ownedSubject($id) { return Subject::where('users_id',Auth::id())->findOrFail($id); }

    public function index() {
        $subjects = Subject::where('users_id', Auth::id())->with(['contents:id,subjects_id,status'])->orderBy('name')->get();
        return view('subject.lista', compact('subjects'))->with('filtro','');
    }
    public function create() { return view('subject.cria'); }
    public function store(Request $request) {
        $data=$request->validate(['name'=>['required','string','max:255'],'description'=>['nullable','string'],'status'=>['nullable','boolean']]);
        $data['users_id']=Auth::id(); $data['status']=$request->boolean('status'); Subject::create($data);
        return redirect()->route('subject.index')->with('msg','Matéria criada com sucesso!');
    }
    // Página da matéria: mostra os conteúdos dela.
    public function show(Request $request, $id) {
        $subject=$this->ownedSubject($id);
        $filtro=trim((string)$request->input('filtro',''));
        $total=$subject->contents()->count();
        $done=$subject->contents()->where('status',true)->count();
        $contents=$subject->contents()
            ->when($filtro!=='', fn($q)=>$q->where('title','like',"%{$filtro}%"))
            ->orderBy('id','desc')->get();
        return view('subject.conteudos',compact('subject','contents','filtro','total','done'));
    }
    public function view($id) {
        $subject=$this->ownedSubject($id);
        return view('subject.visualizar',compact('subject'));
    }
    public function update(Request $request,$id) {
        $data=$request->validate(['name'=>['required','string','max:255'],'description'=>['nullable','string'],'status'=>['nullable','boolean']]);
        $data['status']=$request->boolean('status');
        $this->ownedSubject($id)->update($data);
        return redirect()->route('subject.index')->with('msg','Matéria atualizada com sucesso!');
    }
    // Checkbox de concluir matéria.
    public function toggle(Request $request,$id) {
        $this->ownedSubject($id)->update(['status'=>$request->boolean('status')]);
        return back();
    }
    public function destroy($id) {
        $this->ownedSubject($id)->delete();
        return redirect()->route('subject.index')->with('msg','Matéria excluída com sucesso!');
    }
    public function search(Request $request) {
        $filtro=trim((string)$request->input('filtro',''));
        $subjects=Subject::where('users_id',Auth::id())->where('name','like',"%{$filtro}%")->with(['contents:id,subjects_id,status'])->orderBy('name')->get();
        return view('subject.lista',compact('subjects','filtro'));
    }
}
