<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Mail\ForgetPasswordMail;
use Mail;
use Str;
use Hash;
class AuthController extends Controller
{
    public function login(){

        if(!empty(Auth::check())){
            return redirect('admin.dashboard');
        }
        return view('auth.login');
    }

    public function AuthLogin(Request $request){

        request()->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $remember = !empty($request->remember) ? true :false;

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],$remember)){

            if(Auth::user()->user_type == 1){

                return redirect('admin/dashboard');

            }
            elseif(Auth::user()->user_type == 2){
                return redirect('crm/dashboard');
            }
            elseif(Auth::user()->user_type == 3)
            {
                //dd(Auth::user());
                return redirect('payroll/dashboard');
            }
            elseif(Auth::user()->user_type == 4)
            {
                return redirect('hr/dashboard');
            }
        }
        else{
            return redirect()->back()->with('error','Please enter correct email and password');
        }
    }

    public function logout(){
        Auth::logout();
        return view('auth.login');
    }

    public function forgotPassword(){
        return view('auth.forgot');
    }

    public function postForgotPassword(Request $request){
        $user = User::getEmailSingle($request->email);
        if(!empty($user)){

            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgetPasswordMail($user));
            return redirect()->back()->with('success','Please check your email and reset your password');
        }
        else{
            return redirect()->back()->with('error','Email not found in the system.');
        }
    }

    public function reset($token){
        $user = User::getTokenSingle($token);
       if(!empty($user)){
        $data['user'] = $user;
        return view('auth.reset',$data);
       }
       else{
        abort(404);
       }
    }

    public function postReset($token,Request $request){
        if($request->password == $request->cpassword){
            $user = User::getTokenSingle($token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            return redirect(url(''))->with('success','Password successfully  reset');
        }
        else{
            return redirect()->back()->with('error','Password and Confirm Password Does Not match');
        }
    }
}
