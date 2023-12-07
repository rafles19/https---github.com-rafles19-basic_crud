<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $requests){
        $req = $requests->validate([
            'name' => ['required', 'min:3', 'max:10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:200']
        ]);

        $req['password'] = bcrypt($req['password']);
        $user = User::create($req);
        auth()->login($user);
        return redirect('/');

        return 'Hello Im controller';
    }

    public function logout(){
        auth()->logout();
        return redirect('/');

    }

    public function login(Request $request){

        $validatedData = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);
    
        if (auth()->attempt(['name' => $validatedData['loginname'], 'password' => $validatedData['loginpassword']])){
            $request->session()->regenerate();
        }
    
        return redirect('/');
    }
}
