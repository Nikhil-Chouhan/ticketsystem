<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Tickets_Admin;
use App\Models\Image;
use App\Models\Status;
use App\Models\User;
use App\Models\Progress;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Session;
use App\Models\Companymaster;
use App\Models\Productmaster;
use App\Models\Servicemaster;
use App\Models\Branchmaster;
use Public\images;
use Mail;
use DataTables;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;




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
