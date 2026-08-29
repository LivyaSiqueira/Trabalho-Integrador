<?php
namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    private function ownedSubject($id) { return Subject::where('users_id',Auth::id())->findOrFail($id); }
    private function ownedContent($id) {
        return Content::whereHas('subject',fn($q)=>$q->where('users_id',Auth::id()))->findOrFail($id);
    }
    public function index() {
        $contents=Content::whereHas('subject',fn($q)=>$q->where('users_id',Auth::id()))->with('subject')->orderBy('id','desc')->get();
        return view('content.lista',compact('contents'))->with('filtro','');
    }
    public function create() {
        $subjects=Subject::where('users_id',Auth::id())->orderBy('name')->get();
        return view('content.cria',compact('subjects'));
    }
    public function store(Request $request) {
        $data=$request->validate(['subjects_id'=>['required','integer'],'title'=>['required','string','max:255'],'description'=>['nullable','string'],'status'=>['nullable','boolean']]);
        $this->ownedSubject($data['subjects_id']);
        $data['status']=$request->boolean('status'); Content::create($data);
        return redirect()->route('content.index')->with('msg','Conteúdo criado com sucesso!');
    }
    public function view($id) {
        $content=$this->ownedContent($id);
        $subjects=Subject::where('users_id',Auth::id())->orderBy('name')->get();
        return view('content.visualizar',compact('content','subjects'));
    }
    public function update(Request $request,$id) {
        $data=$request->validate(['subjects_id'=>['required','integer'],'title'=>['required','string','max:255'],'description'=>['nullable','string'],'status'=>['nullable','boolean']]);
        $this->ownedSubject($data['subjects_id']); $data['status']=$request->boolean('status'); $content=$this->ownedContent($id); $content->update($data);
        return redirect()->route('content.index')->with('msg','Conteúdo atualizado com sucesso!');
    }
    public function destroy($id) {
        $content=$this->ownedContent($id); $content->delete();
        return redirect()->route('content.index')->with('msg','Conteúdo excluído com sucesso!');
    }
    public function search(Request $request) {
        $filtro=trim((string)$request->input('filtro',''));
        $contents=Content::whereHas('subject',fn($q)=>$q->where('users_id',Auth::id()))->where('title','like',"%{$filtro}%")->with('subject')->orderBy('id','desc')->get();
        return view('content.lista',compact('contents','filtro'));
    }
}
