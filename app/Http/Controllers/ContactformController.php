<?php

namespace App\Http\Controllers;

use App\Models\contactform;
use Illuminate\Http\Request;

class ContactformController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('store', 'create');
    }
    public function index()
    {
        if (!auth()->user()->admin) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        $contactforms = contactform::all();
        return view('admin.contactforms', compact('contactforms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (!auth()->user()->admin && auth()->user()->id != $contactform->user_id) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        $contactform = contactform::find($id);
        if (!$contactform) {
            return redirect()->route('news.index')->with('status', '404 | Contactform not found!');
        }
        return view('contactform.show', compact('contactform'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(contactform $contactform)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, contactform $contactform)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(contactform $contactform)
    {
        //
    }
}
