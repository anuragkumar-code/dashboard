<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //
    public function showSignIn(){
        return view('signin');
    }

    public function showSignUp(){
        return view('signup');
    }

    

    public function signinUser(Request $request){
        // echo "<pre>"; print_r($_POST);
        request()->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users|regex:/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',
            'password' => 'required|min:4',

        ],[
            'username.required' => 'Username is required.',
            'email.required' => 'Email is required.',
            'password.required' => 'Password is required.',

        ]);

        $username = $request->username;
        $email = $request->email;
        $password = HASH::make($request->password);

        DB::table('users')->insert([
            'name' => $username,
            'email' => $email,
            'password' => $password,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ]);

        return redirect('/sign-in')->withSuccess('You have been registered now, Login here to proceed.');
        
    }

    public function signedIn(Request $request){
        request()->validate([
            'email' => 'required|email|regex:/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',
            'password' => 'required|min:4',

        ],[
            'email.required' => 'Email is required.',
            'password.required' => 'Password is required.',

        ]);

        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect('admin/dashboard');
       } else {
            return back()->with('fail', 'Incorrect Email or Password !');
       }
    }

    public function logout(){
        session()->flush();
        return redirect('/sign-in');
    }

    public function dashboard(){
        return view('admin/dashboard');
    }

    public function showForm(){
        return view('admin/form');
    }

    public function showChart(){
        return view('admin/chart');
    }

    public function showElement(){
        return view('admin/element');
    }

    public function showTable(){
        return view('admin/table');
    }

    public function showTypography(){
        return view('admin/typography');
    }

    public function showButton(){
        return view('admin/buttons');
    }

    public function showWidget(){
        return view('admin/widget');
    }
}
