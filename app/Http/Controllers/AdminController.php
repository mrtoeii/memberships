<?php

namespace App\Http\Controllers;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
class AdminController extends Controller
{
    public function index(Request $request)
    {
        $users = DB::table('users')->paginate(20);;
        $provinces = DB::table('province')->get();
        $data = [
            'users' => $users,
            'provinces'=>$provinces
        ];
        if ($request->ajax()) {
            return view('admin.user_list',$data);
        }
        return view('admin.dashboard',$data);
    }
    public function view_user(Request $request)
    {
        // dd($request->input());
        $user = DB::table('users')->where([
            ['id',$request->input('id')]
            ])->first();
        $provinces = DB::table('province')->get();
        return view('admin.user_edit_form',[
            'user' => $user,
            'provinces'=>$provinces
        ]);
    }
    public function update_user(Request $request)
    {
        // $request->validate([
        //     'firstname' => 'required',
        //     'lastname' => 'required',
        //     'password' => 'required',
        //     'repassword' => 'required',
        //     'gender' => 'required',
        //     'province' => 'required',
        // ]);
        
        $register_controller = new RegisterController();
        $validator = Validator::make($request->all(),$this->rules(),$this->messages());
        if($validator->fails()===false){
            $image = 'no';
            $filename_new='';
            if($_FILES['file']['size']>0){
                $image = DB::table('users')->where('id',$request->input('id'))->first();
                @unlink(public_path($image->image));
                $filename_old = $_FILES['file']['name'];
                $filename_new = $register_controller->refilename($filename_old);
                $image = 'images/'.$filename_new;
                $user = [
                    'firstname'=> $request->input('firstname'),
                    'lastname'=> $request->input('lastname'),
                    'gender'=> $request->input('gender'),
                    'image'=>$image,
                    'province_id'=> $request->input('province'),
                    'modified'=> date('Y-m-d H:i:s'),
                ];
            }else{
                $user = [
                    'firstname'=> $request->input('firstname'),
                    'lastname'=> $request->input('lastname'),
                    'gender'=> $request->input('gender'),
                    'province_id'=> $request->input('province'),
                    'modified'=> date('Y-m-d H:i:s'),
                ];
            }
        
            $update = DB::table('users')
                        ->where('id', $request->input('id'))
                        ->update($user);
            if($update){
                if($_FILES['file']['size']>0){
                    move_uploaded_file($_FILES['file']['tmp_name'],public_path($image));    
                }
                return 1;
            }  
        }else{
            return  response()->json([
                'status'=>500,
                'error'=>$validator->errors()
            ]);
        }
    }
    public function delete_user(Request $request){ 
        $user = DB::table('users')->where('id',$request->input('id'))->first();
        $deleted = false;
        if($user->image=='no'){
            $deleted = true;
        }else{
            if(@unlink(public_path($user->image))){
                $deleted = true;
            }
        }
        if($deleted = true){
            AdminController::deleted_user($user->id);
        }
    }
    private  function deleted_user($id)
    {
         if(DB::table('users')->where('id',$id)->delete()){
            echo  1;
        }
    }
    public function rules()
    {
        return [
            'firstname' => 'required|alpha',
            'lastname' => 'required|alpha',
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
            'gender.required' => 'กรุณาเลือกเพศ',
            'province.required' => 'กรุณาเลือกจังหวัด',
        ];
    }
}
