<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{
    public function index()
    {
        $province = DB::table('province')->get();
        return view('register.index',[
            'province' => $province
        ]);
    }
    public function ramdom_string()
    { 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
        
        for ($i = 0; $i < 10; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
        
        return $randomString; 
    }
    public function refilename($filename_old)
    {
        $extension = pathinfo($filename_old, PATHINFO_EXTENSION);
        $filename_new = RegisterController::ramdom_string().'.'.$extension;
        if(file_exists($filename_new)){
            $filename_new = RegisterController::ramdom_string().$extension;
        }
        return $filename_new;
    }
    public function register_save(Request $request)
    {
        $check_user = DB::table('users')->where([
                        ['firstname', $request->input('firstname')],
                        ['lastname', $request->input('lastname')]
                        ])->get();

        if($check_user->count()>0){
            return 'er1';
            exit;
        }else{
            $validator = Validator::make($request->all(),$this->rules(),$this->messages());
            // dd($validator->fails());
            if($validator->fails()===false){
                $password = $request->input('password');
                $repassword = $request->input('repassword');
                if($password != $repassword){
                    return 'not_match';
                    exit;
                }
                $image = 'no';
                $filename_new='';
                if($_FILES['file']['size']>0){
                    $filename_old = $_FILES['file']['name'];
                    $filename_new = RegisterController::refilename($filename_old);
                    $image = 'images/'.$filename_new;
                }
                $user = [
                    'firstname'=> $request->input('firstname'),
                    'lastname'=> $request->input('lastname'),
                    'password' => Hash::make($request->input('password')),
                    'gender'=> $request->input('gender'),
                    'image'=>$image,
                    'province_id'=> $request->input('province'),
                    'created'=> date('Y-m-d H:i:s'),
                    'status'=> 'user',
                ];
                $insert = DB::table('users')->insert($user);
                if($insert){
                    if($_FILES['file']['size']>0){
                        move_uploaded_file($_FILES['file']['tmp_name'],public_path($image));    
                    }
                    return  response()->json([
                        'status'=>200,
                        'msg'=>'สมัครสมาชิกเรียบร้อยแล้ว'
                    ]);
                }  
            }else {
                return  response()->json([
                    'status'=>500,
                    'error'=>$validator->errors()
                ]);
            }
        }     
    }
    public function rules()
    {
        return [
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
            'password' => 'required|numeric',
            'repassword' => 'required|numeric',
            'gender' => 'required',
            'province' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'firstname.required' => 'กรุณากรอกชื่อ',
            'firstname.alpha' => 'กรุณากรอกเป็นตัวอักษรไทยหรืออังกฤษเท่านั้น',
            'lastname.required' => 'กรุณากรอกนามสกุล',
            'lastname.alpha' => 'กรุณากรอกเป็นตัวอักษรไทยหรืออังกฤษเท่านั้น',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
            'password.numeric' => 'กรอกเป็นตัวเลขเท่านั้น กรุณากรอกใหม่อีกครั้ง',
            'repassword.required' => 'กรุณากรอกรหัสยืนยันรหัสผ่าน',
            'repassword.numeric' => 'กรอกเป็นตัวเลขเท่านั้น กรุณากรอกใหม่อีกครั้ง',
            'gender.required' => 'กรุณาเลือกเพศ',
            'province.required' => 'กรุณาเลือกจังหวัด',
        ];
    }
}
