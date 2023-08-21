<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // show register/create account form 
    public function create(){
        return view('users.register');
    }

    // store new user data  
    public function store(Request $request){
        $formData = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        $formData['password'] = bcrypt($formData['password']);

        $user = User::create($formData);

        // login
        auth()->login($user);

        return redirect('/')->with('msgSuccess', 'Register successfully');
    }

    // logout user
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('msgSuccess','Logout successfully');
    }

    // show login form 
    public function login(){
        return view('users.login');
    }

    // login user 
    public function authenticate(Request $req){
        $formData = $req->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formData)){
            $req->session()->regenerate(); // generate session id
        
            return redirect('/')->with('msgSuccess', 'Login successfully');
        } 

        // show this error msg only below email input
        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }
}
 