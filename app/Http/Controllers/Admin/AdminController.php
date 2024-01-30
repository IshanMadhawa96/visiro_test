<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class AdminController extends Controller
{
    //view all users
    public function list(){
        $data['getRecord'] = User::getUsers();
        $data['header_title'] = 'Users List';
        return view('admin.users.list',$data);
    }

    // landing add new user page
    public function add(){

        $data['header_title'] = 'Admin new User';
        return view('admin.users.add',$data);
    }

    // add new user action
    public function insert(Request $request){
        request()->validate([
         'name'=>'required',
         'email'=>'required|email|unique:users',
         'user_type'=>'required',
         'password' => [
            'required',
            'string',
            'min:8',
            'not_regex:/\b(data|username|email)\b/i', // Does not contain "data", "username", or "email"
        ],
        ]);
        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->user_type = trim($request->user_type);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('admin/users/list')->with('success','User successfully created');
    }

    //landing page link
    public function edit($id){
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord'])){
            $data['header_title'] = 'Edit User Info';
            return view('admin.users.edit',$data);
        }
        else{
            abort(404);
        }
    }
    // update user
    public function update(Request $request,$id){
        request()->validate([
            'email'=>'required|email|unique:users,email,'.$id
        ]);
       $user = User::getSingle($id);;
       $user->name = trim($request->name);
       $user->email = trim($request->email);
       if(!empty($request->password)){
        $user->password = Hash::make($request->password);
       }
       $user->save();
       return redirect('admin/users/list')->with('success','User successfully Updated');
    }

    // delete user
    public function delete($id){
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();
        return redirect('admin/users/list')->with('success','User successfully deleted');
    }

}
