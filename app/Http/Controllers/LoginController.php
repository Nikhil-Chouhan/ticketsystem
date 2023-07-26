<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // public function show()
    // {
    //     return view('index');
    // }

    public function login(Request $request)
    {
       
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        // dd(bcrypt($request->password));
        if (Auth::attempt($credentials)) {
            return redirect('dashboard');
        }
        else{
            return redirect('/')->withSuccess('Login details are not valid');
        }
 
        // $user = Auth::getProvider()->retrieveByCredentials($credentials);
        // Auth::login($user);                                     
        // return $this->authenticated($request, $user);
    
    }

    public function logout()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('/');
    }


    // protected function authenticated(Request $request, $user) 
    // {
    //     return redirect()->intended();
    // }
}
