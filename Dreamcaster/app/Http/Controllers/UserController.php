<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:255'
        ]);

        $user = new User;

        $user->name = htmlspecialchars($request->name);
        $user->email = htmlspecialchars($request->email);
        $user->password = htmlspecialchars($request->password);

        $user->save();

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        Auth::attempt($credentials);

        return redirect('/');
    }

    public function delete(Request $request)
    {
        return response('Blame Cappe', 501);    // Temporary until done

        $user = Panel::where('user_id', Auth::user()['id'])->first();

        $user->delete();

        return redirect('/');
    }

    public function channel(Request $request, $channel){
        return view('stream')->with('user', userInfo())->with('channel', $channel);
    }

    public function get(Request $request){
        $user = User::select('name' /* REMEMBER TO ADD THE REST*/)->where('id', $request->id)->first();
        return $user ? $user : ['name' => null];
    }
}

function userInfo(){
    if (Auth::user())
        return ['name' => Auth::user()['name'], 'id' => Auth::user()['id']];
    else
        return ['name' => 'Guest', 'id' => 0];
}