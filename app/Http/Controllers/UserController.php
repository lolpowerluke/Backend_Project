<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DateTime;

class UserController extends Controller
{
    public function show($id) {
        $user = User::find($id);
        if(!$user) {
            return redirect()->route('news.index')->with('status', '404 | User not found!');
        }
        $user->birthday = DateTime::createFromFormat('Y-m-d', $user->birthday)->format('d/m/Y');
        $age = date_diff(date_create($user->birthday), date_create('now'))->y;
        return view('user.show', compact('user', 'age'));
    }
    public function edit($id) {
        $user = User::find($id);
        if(!$user) {
            return redirect()->route('news.index')->with('status', '404 | User not found!');
        }
        return view('user.edit', compact('user'));
    }
    public function update(Request $request, $id) {
        $user = User::find($id);
        if(!$user) {
            return redirect()->route('news.index')->with('status', '404 | User not found!');
        }
        DateTime::createFromFormat('d/m/Y', $request->input('birthday'));
        $validated = $request->validate([
            'name' => 'required|max:255',
            'birthday' => 'date|before:today',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'bio' => 'max:255'
        ]);
        $user->name = $validated['name'];
        $user->birthday = $validated['birthday'];
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $user->image_name = $imageName;
        }
        $user->bio = $validated['bio'];
        $user->save();
        return redirect()->route('user.show', $user->id)->with('status', 'User updated!');
    }
    public function destroy($id) {
        if(!auth()->user()->admin) {
            return redirect()->route('news.index')->with('status', '403 | You are not allowed to access this page!');
        }
        $user = User::find($id);
        if(!$user) {
            return redirect()->route('news.index')->with('status', '404 | User not found!');
        }
        $user->name = '[deleted user]';
        $user->email = '';
        $user->password = '';
        $user->image_name = 'default.jpg';
        $user->admin = false;
        $user->bio = '';
        $user->save();
        return redirect()->route('news.index')->with('status', 'User deleted!');
    }
}
