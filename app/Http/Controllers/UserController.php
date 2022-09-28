<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Rule
 public function create(Request $request) {
    return view('users.register');
 }
 public function login(Request $request) {
    return view('users.login');
 }
 public function store(Request $request) {
    $formFields = $request->validate([
        'name' => ['required', 'min:3'],
        'email' => ['required', 'email', Rule::unique('users', 'email')],
        'password' => 'required|confirmed|min:6'
    ]);

    // Hash Password
    $formFields['password'] = bcrypt($formFields['password']);

    // Create User
    $user = User::create($formFields);

    // Login
    auth()->login($user);

    return redirect('/')->with('message', 'User created and logged in');
}
public function authenticate(Request $request) {
    $formFields = $request->validate([
        'email' => ['required', 'email'],
        'password' => 'required'
    ]);
    //     $user = User::where('email' ,$formFields['email'])->first();
//    if($user == null) {
//     return back()->withErrors(['email' => 'Invalid Credentials']);
//    }
//    if( ! Hash::check($user['password'], $formFields['password']) )  {
//     return back()->withErrors(['password' => 'Invalid password']);
//    }
//      auth()->login($user);

    if(auth()->attempt($formFields)) {
        $request->session()->regenerate();

        return redirect('/')->with('message', 'You are now logged in!');
    }

    return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
}
    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out!');

    }
 }
