<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Gregwar\Captcha\CaptchaBuilder;

class LoginController extends CommonController
{
    public function login()
    {
        $captcha = $_SESSION['phrase'];
        if($input = Input::all()){
            if($input['captcha'] !== $captcha){
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
    public function quit()
    {
        session(['user' => null]);
        return redirect('admin/login');
    }
    public function getCode()
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build( $width = 103,$height = 20,$font = null );
        $_SESSION['phrase'] = $builder->getPhrase();
        header('Content-type: image/jpeg');
        $builder->output();
    }
}
