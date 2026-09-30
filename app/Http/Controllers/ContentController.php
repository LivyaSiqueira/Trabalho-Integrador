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
        return Content::whereHas('subject',fn($q)=>$q->where('users_id',Auth::id()))->with('subject')->findOrFail($id);
    }
    private function rules() {
        return ['title'=>['required','string','max:255'],'description'=>['nullable','string'],'status'=>['nullable','boolean']];
    }

    // Conteúdos são criados dentro de uma matéria.
    public function create($subjectId) {
        $subject=$this->ownedSubject($subjectId);
        return view('content.cria',compact('subject'));
    }
    public function store(Request $request,$subjectId) {
        $subject=$this->ownedSubject($subjectId);
        $data=$request->validate($this->rules());
        $data['subjects_id']=$subject->id; $data['status']=$request->boolean('status');
        Content::create($data);
        return redirect()->route('subject.show',$subject->id)->with('msg','Conteúdo criado com sucesso!');
    }
    public function view($id) {
        $content=$this->ownedContent($id);
        return view('content.visualizar',compact('content'));
    }
    public function update(Request $request,$id) {
        $content=$this->ownedContent($id);
        $data=$request->validate($this->rules());
        $data['status']=$request->boolean('status');
        $content->update($data);
        return redirect()->route('subject.show',$content->subjects_id)->with('msg','Conteúdo atualizado com sucesso!');
    }
    // Checkbox de concluir conteúdo.
    public function toggle(Request $request,$id) {
        $this->ownedContent($id)->update(['status'=>$request->boolean('status')]);
        return back();
    }
    public function destroy($id) {
        $content=$this->ownedContent($id); $subjectId=$content->subjects_id; $content->delete();
        return redirect()->route('subject.show',$subjectId)->with('msg','Conteúdo excluído com sucesso!');
    }
}
