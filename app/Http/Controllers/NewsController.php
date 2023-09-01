<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Like;
use App\Models\Comment;
use Auth;

class NewsController extends Controller
{
  public function __construct() {
    $this->middleware('auth')->except(['index', 'show']);
  }
  public function index(Request $request) {
    if($request->input('search') == '') {
        $news = News::orderBy('created_at', 'desc')->paginate(5);
    } else {
        $news = News::where('title', 'LIKE', '%'.$request->input('search').'%')->orderBy('created_at', 'desc')->paginate(5);
    }
    return view('news.index', compact('news'));
  }
  public function create() {
    return view('news.create');
  }
  public function store(Request $request) {

    $validated = $request->validate([
      'title' => 'required|min:3',
      'short_desc' => 'required|min:10',
      'content' => 'required|min:50',
      'image' => 'required|image|mimes:jpeg,png,jpg'
    ]);

    $imageName = time().'-'.$request->title.'.'.$request->image->extension();
    
    $request->image->move(public_path('images'), $imageName);

    $news = new News();
    $news->title = $validated['title'];
    $news->short_desc = $validated['short_desc'];
    $news->content = $validated['content'];
    $news->user_id = Auth::id();
    $news->image_name = $imageName;
    $news->save();

    return redirect()->route('news.index')->with('status', 'News item created!');
  }
  public function show($id) {
    $news = News::findOrFail($id);
    return view('news.show', compact('news'));
  }
  public function edit($id) {
    $news = News::find($id);
    if(!$news) {
        return redirect()->route('news.index')->with('status', '404 | News item not found!');
    }

    if($news->user_id != Auth::id()) {
      return redirect()->route('news.index')->with('status', '403 | You are not allowed to edit this news item!');
    }
    return view('news.edit', compact('news'));
  }
  public function update(Request $request, $id) {
    $validated = $request->validate([
      'title' => 'required|min:3',
      'short_desc' => 'required|min:10',
      'content' => 'required|min:50',
      'image' => 'image|mimes:jpeg,png,jpg'
    ]);
    $news = News::find($id);
    if(!$news) {
      return redirect()->route('news.index')->with('status', '404 | News item not found!');
    }
    if($news->user_id != Auth::id()) {
      return redirect()->route('news.index')->with('status', '403 | You are not allowed to edit this news item!');
    }
    $news->title = $validated['title'];
    $news->short_desc = $validated['short_desc'];
    $news->content = $validated['content'];
    if($request->hasFile('image')) {
      $imageName = time().'-'.$request->title.'.'.$request->image->extension();
      $request->image->move(public_path('images'), $imageName);
      $news->image_name = $imageName;
    }
    $news->save();

    return redirect()->route('news.index')->with('status', 'News item updated!');
    }
    public function destroy($id) {
        $news = News::find($id);
        if(!$news) {
            return redirect()->route('news.index')->with('status', '404 | News item not found!');
        }
        if($news->user_id != Auth::id() && !Auth::user()->admin) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to delete this news item!');
        }
        //delete all likes of this post
        $likes = Like::where('news_id', $id)->get();
        foreach($likes as $like) {
            $like->delete();
        }
        //delete all comments of this post
        $comments = Comment::where('news_id', $id)->get();
        foreach($comments as $comment) {
            $comment->delete();
        }
        //delete the post
        $news->delete();
        return redirect()->route('news.index')->with('status', '200 | News item succesfully deleted!');
    }
}