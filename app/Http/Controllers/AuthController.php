<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
class AuthController extends Controller
{
    public function index()
    {
        // echo Hash::make('@Admin');
        return view('login.index');
    }

    public function checkLogin(Request $request)
    {

        $validator = Validator::make($request->all(),$this->rules(),$this->messages());
        $user = DB::table('auth')->where('username',$request->input('username'))->first();
        if($validator->fails()===false){
            if($user){
                if (Hash::check($request->input('password'), $user->password)) {
                    $userArr = array(
                        'username'=>$user->username,
                    );
                    session()->put('user',$userArr);
                    return 1;
                }else{
                    return 'er1';
                }
            }else{
                return 'er1';
            }
        }else{
            return  response()->json([
                'status'=>500,
                'error'=>$validator->errors()
            ]);
        }
    }
    public function logout(Request $request){
        $request->session()->flush();
        return  redirect('login');
    }
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'กรุณากรอกผู้ใช้งาน',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
        ];
    }
}
