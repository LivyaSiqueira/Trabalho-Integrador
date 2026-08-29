<?php
namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index() {
        $subjects = Subject::where('users_id', Auth::id())->withCount('contents')->with(['contents:id,subjects_id,status'])->orderBy('name')->get();
        return view('subject.lista', compact('subjects'))->with('filtro','');
    }
    public function create() { return view('subject.cria'); }
    public function store(Request $request) {
        $data=$request->validate(['name'=>['required','string','max:255'],'description'=>['nullable','string']]);
        $data['users_id']=Auth::id(); Subject::create($data);
        return redirect()->route('subject.index')->with('msg','Matéria criada com sucesso!');
    }
    public function view($id) {
        $subject=Subject::where('users_id',Auth::id())->findOrFail($id);
        return view('subject.visualizar',compact('subject'));
    }
    public function update(Request $request,$id) {
        $data=$request->validate(['name'=>['required','string','max:255'],'description'=>['nullable','string']]);
        $subject=Subject::where('users_id',Auth::id())->findOrFail($id); $subject->update($data);
        return redirect()->route('subject.index')->with('msg','Matéria atualizada com sucesso!');
    }
    public function destroy($id) {
        $subject=Subject::where('users_id',Auth::id())->findOrFail($id); $subject->delete();
        return redirect()->route('subject.index')->with('msg','Matéria excluída com sucesso!');
    }
    public function search(Request $request) {
        $filtro=trim((string)$request->input('filtro',''));
        $subjects=Subject::where('users_id',Auth::id())->where('name','like',"%{$filtro}%")->with(['contents:id,subjects_id,status'])->orderBy('name')->get();
        return view('subject.lista',compact('subjects','filtro'));
    }
}
