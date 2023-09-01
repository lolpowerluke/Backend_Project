<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use Auth;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::all();
        return view('about.index', compact('about'));
    }
}
