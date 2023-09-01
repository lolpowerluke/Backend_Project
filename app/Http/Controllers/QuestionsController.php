<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\question;
use App\Models\comment;
use App\Models\categorie;
use App\Models\Like;

use Auth;

class QuestionsController extends Controller
{
    public function faq()
    {
        $categories = categorie::all();
        $questions = question::all();
        return view('faq.index', compact('categories', 'questions'));
    }

    public function show($id)
    {
        $question = question::find($id);
        return view('question.show', compact('question'));
    }

    public function index() {
        $categories = categorie::all();
        $questions = question::all();
        return view('question.index', compact('categories', 'questions'));
    }

    public function create() {
        return view('question.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10'
        ]);

        $question = new question();
        $question->title = $validated['title'];
        $question->content = $validated['content'];
        $question->user_id = Auth::id();
        $question->save();

        return redirect()->route('question.index')->with('status', 'Question created!');
    }

    public function edit($id) {
        $question = question::find($id);
        if(!$question) {
            return redirect()->route('question.index')->with('status', '404 | Question not found!');
        }

        if($question->user_id != Auth::id()) {
            return redirect()->route('question.index')->with('status', '403 | You are not allowed to edit this question!');
        }

        return view('question.edit', compact('question'));
    }

    public function update(Request $request, $id) {
        $validated = $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:10'
        ]);

        $question = question::find($id);
        $question->title = $validated['title'];
        $question->content = $validated['content'];
        $question->save();

        return redirect()->route('question.index')->with('status', 'Question updated!');
    }

    public function destroy($id) {
        $question = question::find($id);
        $comments = comment::where('question_id', $id)->get();
        foreach($comments as $comment) {
            $comment->delete();
        }
        $likes = Like::where('question_id', $id)->get();
        foreach($likes as $like) {
            $like->delete();
        }
        $question->delete();
        return redirect()->route('question.index')->with('status', 'Question deleted!');
    }
}
