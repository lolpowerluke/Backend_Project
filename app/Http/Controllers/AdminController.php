<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\News;
use App\Models\Question;
use App\Models\Categorie;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if(!auth()->user()->admin) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        return view('admin.index');
    }

    public function adminUsers() {
        if(!auth()->user()->admin) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        return view('admin.users');
    }

    public function adminNews() {
        if(!auth()->user()->admin) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        return view('admin.news');
    }

    public function adminQuestions() {
        if(!auth()->user()->admin) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        return view('admin.questions');
    }

    public function adminComments() {
        if(!auth()->user()->admin) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        return view('admin.comments');
    }

    public function adminCategories() {
        if(!auth()->user()->admin) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        return view('admin.categories');
    }

    public function searchUserByName(Request $request) {
        if(!auth()->user()->admin) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        if($request->input('search') == '') {
            $users = User::where('name', '!=', '[deleted user]')->where('admin', '!=', 1)->get();
        } else {
            $users = User::where('name', 'like', '%' . $request->input('search') . '%')->where('name', '!=', '[deleted user]')->where('admin', '!=', 1)->get();
        }
        return view('admin.userSearch', compact('users'));
    }

    public function makeUserAdmin($id) {
        if(!auth()->user()->admin) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        $user = User::find($id);
        $user->admin = true;
        $user->save();
        return redirect()->route('admin.users')->with('status', 'User is now an admin!');
    }

    public function searchUserToDelete(Request $request) {
        if(!auth()->user()->admin) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        if($request->input('search') == '') {
            $users = User::where('name', '!=', '[deleted user]')->get();
        } else {
            $users = User::where('name', 'like', '%' . $request->input('search') . '%')->where('name', '!=', '[deleted user]')->get();
        }
        return view('admin.searchUserToDelete', compact('users'));
    }

    public function searchNewsByTitle(Request $request) {
        if(!auth()->user()->admin) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        if($request->input('search') == '') {
            $news = News::all();
        } else {
            $news = News::where('title', 'like', '%' . $request->input('search') . '%')->get();
        }
        return view('admin.searchNews', compact('news'));
    }

    public function searchQuestionsByTitle(Request $request) {
        if(!auth()->user()->admin) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        if($request->input('search') == '') {
            $question = Question::all();
        } else {
            $question = Question::where('title', 'like', '%' . $request->input('search') . '%')->get();
        }
        return view('admin.searchQuestions', compact('question'));
    }

    public function searchToAddToFAQ(Request $request) {
        if(!auth()->user()->admin) {
          return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        $categories = Categorie::all();
        if($request->input('search') == '') {
          $questions = Question::where('is_faq', '=', 0)->get();
        } else {
          $questions = Question::where('title', 'like', '%' . $request->input('search') . '%')->where('is_faq', '=', 0)->get();
        }
        return view('admin.searchToAddToFAQ', compact('questions', 'categories'));
    }

    public function addToFAQ($id) {
        if(!auth()->user()->admin) {
          return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        $question = Question::find($id);
        $question->is_faq = true;
        $question->save();
        return redirect()->route('admin.searchToAddToFAQ')->with('status', 'Question added to FAQ!');
    }

    public function searchQuestionsToRemove(Request $request) {
        if(!auth()->user()->admin) {
          return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        if($request->input('search') == '') {
          $questions = Question::all();
        } else {
            $questions = Question::where('title', 'like', '%' . $request->input('search') . '%')->get();
        }
        return view('admin.searchQuestionsToRemove', compact('questions'));
    }

    public function addQuestionToCategory(Request $request, $id) {
        if(!auth()->user()->admin) {
          return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        $question = Question::find($id);
        $question->categorie_id = $request->input('category_id');
        $question->save();
        return redirect()->route('admin.searchToAddToCategory')->with('status', 'Question added to category!');
    }

    public function searchCategoriesToRemove(Request $request) {
        if(!auth()->user()->admin) {
          return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        if($request->input('search') == '') {
          $categories = Categorie::all();
        } else {
            $categories = Categorie::where('name', 'like', '%' . $request->input('search') . '%')->get();
        }
        return view('admin.searchCategoriesToRemove', compact('categories'));
    }
    
    public function searchToAddToCategory(Request $request) {
        if(!auth()->user()->admin) {
          return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        if($request->input('search') == '') {
          $questions = Question::where('categorie_id', '=', null)->get();
        } else {
            $questions = Question::where('title', 'like', '%' . $request->input('search') . '%')->where('categorie_id', '=', null)->get();
        }
        $categories = Categorie::all();
        return view('admin.searchToAddToCategory', compact('questions', 'categories'));
    }

    public function createCategory() {
        if(!auth()->user()->admin) {
          return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        return view('admin.createCategory');
    }

    public function storeCategory(Request $request) {
        if(!auth()->user()->admin) {
          return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        $categorie = new Categorie();
        $categorie->name = $request->input('name');
        $categorie->save();
        return redirect()->route('admin.createCategory')->with('status', 'Category created!');
    }

    public function deleteCategory($id) {
        if(!auth()->user()->admin) {
          return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        //update all questions with this categorie to have no categorie
        $questions = Question::where('categorie_id', '=', $id)->get();
        foreach($questions as $question) {
            $question->categorie_id = null;
            $question->save();
        }
        $categorie = Categorie::find($id);
        $categorie->delete();
        return redirect()->route('admin.searchCategoriesToRemove')->with('status', 'Category deleted!');
    }
}
