<?php

namespace App\Http\Controllers\Admin\Auth;


use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Models\TypeMerchant;
use App\Rules\IntroMobile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        Auth::guard()->logout();
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => ['required','email'],
            'password' =>  ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('dashboard.home')->with('success' , 'The login process has been completed successfully');
        }

        return redirect()->back()->withErrors(['error'=> 'اسم المستخدم او كلمة المرور خطأ']);

    }

    public function logout()
    {
        Auth::guard()->logout();
        return  redirect()->route('login');
    }
}
