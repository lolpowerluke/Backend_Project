<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\News;
use Auth;

class LikeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function like($newsId, Request $request) {
        $news = News::find($newsId);
        if(!$news) {
            return redirect()->route('news.index')->with('status', '404 | News item not found!');
        }

        $like = Like::where('user_id', Auth::user()->id)->where('news_id', $newsId)->first();
        $news = News::find($newsId);
        if($like) {
            return redirect()->route('news.index')->with('status', '403 | You already liked this news item!');
        } else if ($news->user_id == Auth::user()->id) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to like your own news item!');
        }

        $news = \App\Models\News::find($newsId);
        $like = new Like;
        $like->user_id = Auth::user()->id;
        $like->news_id = $newsId;
        $like->save();
        return redirect()->route('news.index')->with('status', 'News item liked!');
    }
}
