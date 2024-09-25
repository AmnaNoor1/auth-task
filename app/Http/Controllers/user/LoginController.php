<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //show login page for general user 
    public function index(){
        return view('user.login');
    }

    //authenticate
    public function authenticate(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('account.dashboard');
            } else {
                return redirect()->route('account.login')->with('error','Either email or password is incorrect.');
            }
            

        } else {
            return redirect()->route('account.login')
            ->withInput()
            ->withErrors($validator);
        }
    }

    //register
    public function register(){
       return view('user.register');
    }

    //
    public function processRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required | email | unique:users',
            'password' => 'required | confirmed | min:8',
            'password_confirmation' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->passes()) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'customer';
            $user->gender = $request->gender;
            $user->profile_picture = $profilePicturePath;
            $user->save();
            return redirect()->route('account.login')->with('success','you have registred successfully');

        } else {
            return redirect()->route('account.register')
            ->withInput()
            ->withErrors($validator);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
    }
    }
