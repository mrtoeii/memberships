@extends('layouts')

@section('title', 'เข้าสู่ระบบ')

@section('content')
<script>
    $(document).ready(function(){
        $('#btn-login').click(function (){
            var formData = new FormData($('#login_form')[0]);
            $.ajax({
                url: '{{url("checklogin")}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                success: function(data){
                    if(data.status==500){
                        if(data.error.username){
                            $('#div_error_username').html(data.error.username);
                        }else{
                            $('#div_error_username').html('');
                        }

                        if(data.error.password){
                            $('#div_error_password').html(data.error.password);
                        }else{
                            $('#div_error_password').html('');
                        }
                    }else if(data==1){
                        $('#div_error_login').html('')
                        window.location.replace("dashboard");
                    }else if(data=='er1'){
                        $('#div_error_login').html('ชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง กรุณากรอกใหม่อีกครั้ง')
                    }
                }
            });
        })
    })
</script>
<form id="login_form" onsubmit="return false">
    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="login"><h2>เข้าสู่ระบบ</h2></label>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="username">ชื่อผู้ใช้งาน</label>
            <input type="text" class="form-control" id="username" name="username"  required>
            <div class="error" id="div_error_username"></div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="password">รหัสผ่าน</label>
            <input type="password" class="form-control" id="password" name="password"  required>
            <div class="error" id="div_error_password"></div>
        </div>
    </div>
    <div class="error" id="div_error_login"></div>
    <div class="form-row">
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary" id="btn-login">Login</button>
        </div>
    </div>
</form>
@endsection