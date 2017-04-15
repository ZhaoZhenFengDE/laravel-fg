<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Model\User;

class IndexController extends CommonController
{
    public function index()
    {
        return view('admin.index');
    }

    public function info()
    {
        return view('admin.info');
    }
    //更改管理员权限密码
    public function psw()
    {
        $input = Input::all();
        if($input){
            $rules = [
                'password'=>'required|between:6,20|confirmed',
            ];
            $message = [
                'password.required'=>'新密码不为空',
                'password.between'=>'新密码须在6-20位',
                'password.confirm'=>'新密码确认密码不相同'
            ];
            $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                $user = User::first();
                $_password = Crypt::decrypt($user->user_psw);
                if($input['password_o']==$_password){
                    $user->user_psw = Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors','密码修改成功！');
                }else{
                    return back() -> with('errors','原密码错误!');
                }
            }else{
                return back() -> withErrors($validator);
            }
        }else{

        }
        return view('admin.psw');
    }
}
