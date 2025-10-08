<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|confirmed',
            'age' => 'required|integer|min:1|max:120',
            'role' => 'required|in:admin,guest',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        if($user){
            return redirect()->route('login');
        }
    }

    public function login(Request $request){
        $credientials = $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if(Auth::attempt($credientials)){
            return redirect()->route('dashboard');
        }
    }

    public function dashboardPage(){
            return view('dashboard');
         
    }

     public function innerPage(){
            return view('inner');
        
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
