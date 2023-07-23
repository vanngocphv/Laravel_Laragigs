<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Show register/create form for user
    public function create(){

        return view('users.register');
    }

    //Store method, for save new user, post method
    public function store(Request $request){
        $formValues = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        //hash pasword for stored
        $formValues['password'] = bcrypt($formValues['password']);

        //store user for auto login after create
        $user = User::create($formValues);

        //login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    //login function, get method
    public function login(){
        
        return view('users.login');
    }
    //login function, post method
    public function authenticate(Request $request){
        //check valid input data
        $formValues = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        //attemp login
        if(auth()->attempt($formValues)){
            $request->session()->regenerate();

            return redirect('/')->with('message', "You have been logged!");
        }

        return back()->withErrors(['email' => 'Invalid Credential'])->onlyInput('email');
    }

    //logout function
    public function logout(Request $request){

        auth()->logout();

        //because clear all value
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');
    }

    //show manage list
    public function manage(){
        return view('users.manage', [
            'listings' => auth()->user()->listings
        ]);
    }
}
