<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|min:10',
            'question_id' => 'required|exists:questions,id'
        ]);

        $comment = new comment();
        $comment->user_id = Auth::id();
        $comment->content = $validated['content'];
        $comment->question_id = $validated['question_id'];
        $comment->save();
      
        return redirect()->route('question.show', $validated['question_id'])->with('status', 'Comment created!');
    }
    /** 
     * show comment and question
     */
    public function show($id) {
        $comment = comment::find($id);
        $question = $comment->question;
        return view('question.show', compact('comment', 'question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, comment $comment) {
        $validated = $request->validate([
            'content' => 'required|min:10',
            'question_id' => 'required|exists:questions,id'
        ]);
    
        $comment->content = $validated['content'];
        $comment->save();

        return redirect()->route('question.show', $validated['question_id'])->with('status', 'Comment updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(comment $comment) {
        $comment->delete();
        return redirect()->route('question.show', $comment->question_id)->with('status', 'Comment deleted!');
    }
}
