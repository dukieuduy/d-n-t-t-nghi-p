<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class UserController extends Controller
{
    public function login(){
        return view('client/pages.login');
    }
    public function postLogin(Request $request){
        $this->validate($request,[
            'email' => 'required|email', // 'email' là bắt buộc và phải là email hợp lệ, email đã tồn tại 
            'password' => 'required|min:8', // Mật khẩu yêu cầu, phải khớp và ít nhất 8 ký tự

        ],[
            'email.required' => 'Địa chỉ email là bắt buộc.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('home');
        }else{
            return redirect()->back()->with('error','sai thông tin');
        }
    }
    public function register(){
        return view('client/pages.home');
    }
    public function postRegister(Request $request){
        // dd($request->all());

        // dd(Hash::make($request->password));
        $this->validate($request,[
            'name'=>'required',
            'email' => 'required|email|unique:users,email', // 'email' là bắt buộc và phải là email hợp lệ, email đã tồn tại 
            'password' => 'required|confirmed|min:8', // Mật khẩu yêu cầu, phải khớp và ít nhất 8 ký tự

        ],[
            'name.required'=>'Không được bỏ trống tên',
            'email.required' => 'Địa chỉ email là bắt buộc.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Địa chỉ email đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.confirmed' => 'Mật khẩu và xác nhận mật khẩu không khớp.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
        ]);
        $request->merge(['password'=>Hash::make($request->password)]);
        try {
            User::create($request->all());
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('login');

    }
    public function logout(){
        Auth::logout();
        return redirect()->back();
    }

    public function testEmail(){
        Mail::send('client.pages.email.test',['name'=>'test mail name'],function($email){
            $email->to('dukdph34015@fpt.edu.vn','đồ đồng nát');
        });
    }

    public function forgetPass(){
        return view('client.pages.email.forgetPass');
    }
    public function postForgetPass(){}
}

