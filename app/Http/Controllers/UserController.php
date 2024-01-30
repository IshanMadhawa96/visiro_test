<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function changePassword(){
        $data['header_title'] = 'Change Password';
        return view('profile.change_password',$data);
    }

    public function updateChangePassword(Request $request){
        $user = User::getSingle(Auth::user()->id);
        if(Hash::check($request->password,$user->password))
        {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', 'Password Successfully Updated');
        }
        else{
          return redirect()->back()->with('error', 'Old password is not Correct');
        }
    }
}
