<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'Resources\org\code\Code.php';

class LoginController extends CommonController
{
    public function login()
    {
        if($input = Input::all()){
            $code = new \Code;
            $_code = strtoupper($code -> get());
            if(strtoupper($input['code'])!=$_code){
                return back()->with('msg','验证码错误！');
            }
            $user = User::first();
            if($user->user_name != $input['user_name'] || Crypt::decrypt($user->user_psw) != $input['user_psw']){
                return back()->with('msg','用户名不存在或密码错误');
            }
            session(['user'=>$user]);
            return redirect('admin/index');
        }else{
            session(['user'=>null]);
            return view('admin.login');
        }
    }
    public function code()
    {
        $code = new \Code;
        $code -> make();
    }
    public function quit()
    {
        session(['user' => null]);
        return redirect('admin/login');
    }
}