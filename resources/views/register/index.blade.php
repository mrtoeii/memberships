@extends('layouts')

@section('title', 'สมัครสมาชิก')


@section('content')
        <style>
          
        </style>
        <script>
            $(document).ready(function(){
                $('#btn-save').click(function (){
                    var formData = new FormData($('#register_form')[0]);
                    $.ajax({
                        url: '{{url("register.save")}}',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        type: 'POST',
                        success: function(data){
                            if(data.status==500){
                                if(data.error.firstname){
                                    $('#div_error_firstname').html(data.error.firstname);
                                }else{
                                    $('#div_error_firstname').html('');
                                }

                                if(data.error.lastname){
                                    $('#div_error_lastname').html(data.error.lastname);
                                }else{
                                    $('#div_error_lastname').html('');
                                }

                                if(data.error.password){
                                    $('#div_error_password').html(data.error.password);
                                }else{
                                    $('#div_error_password').html('');
                                }

                                if(data.error.repassword){
                                    $('#div_error_repassword').html(data.error.repassword);
                                }else{
                                    $('#div_error_repassword').html('');
                                }

                                if(data.error.gender){
                                    $('#div_error_gender').html(data.error.gender);
                                }else{
                                    $('#div_error_gender').html('');
                                }

                                if(data.error.province){
                                    $('#div_error_province').html(data.error.province);
                                }else{
                                    $('#div_error_province').html('');
                                }
                            }else if(data.status==200){ 
                                alert(data.msg)
                                document.getElementById("register_form").reset();
                            }else if(data == 'not_match'){
                                    alert('รหัสผ่านไม่ตรงกัน กรุณากรอกรหัสผ่านใหม่อีกครั้ง');
                            }else if(data == 'er1'){
                                    alert('ชื่อ-สกุลนี้ มีอยู่ในระบบแล้วกรุณากรอกชื่อสกุลใหม่');
                            }
                        }
                    });
                })
                // $('#firstname').keyup(function (event){
                //     var pattern = /^[ก-๏\sa-zA-Z\s]+$/;
                //     var input = $(this).val();
                //     if(input !=''){
                //         if(!input.match(pattern)){ 
                //             $('#div_error_firstname').html("กรอกตัวอักษรภาษาไทยหรือภาษาอังกฤษ กรุณากรอกใหม่อีกครั้ง");
                //             return false;
                //         }else{
                //              $('#div_error_firstname').html("");
                //         }
                //     }
                // })
                // $('#lastname').keyup(function (event){
                //     var pattern = /^[ก-๏\sa-zA-Z\s]+$/;
                //     var input = $(this).val();
                //     if(input !=''){
                //         if(!input.match(pattern)){ 
                //             $('#div_error_lastname').html("กรอกตัวอักษรภาษาไทยหรือภาษาอังกฤษ กรุณากรอกใหม่อีกครั้ง");
                //             return false;
                //         }else{
                //              $('#div_error_lastname').html("");
                //         }
                //     }
                // })
            })
            function inputDigits_password(){
                var password = $('#password').val()
                var regExp = /[0-9]$/;
                if(!regExp.test(password)){
                    $('#div_error_password').html('กรอกตัวเลขเท่านั้น กรุณากรอกใหม่อีกครั้ง')
                    return false;
                }else{
                    $('#div_error_password').html('')
                }
            }
            function inputDigits_repassword(){
                var repassword = $('#repassword').val()
                var regExp = /[0-9]$/;
                if(!regExp.test(repassword)){
                    $('#div_error_repassword').html('กรอกตัวเลขเท่านั้น กรุณากรอกใหม่อีกครั้ง')
                    return false;
                }else{
                    $('#div_error_repassword').html('')
                }
            }
        </script>
    <form id="register_form" onsubmit="return false">
     
                <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="register"><h2>สมัครสมาชิกผู้ใช้งาน</h2></label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="firstname">ขื่อ</label>
                      <input type="text" class="form-control" id="firstname" name="firstname" >
                      <div class="error" id="div_error_firstname"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname">นามสกุล</label>
                        <input type="text" class="form-control" id="lastname" name="lastname"  >
                        <div class="error" id="div_error_lastname"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="password">รหัสผ่าน</label>
                      <input type="password" class="form-control" id="password" name="password" >
                      <div class="error" id="div_error_password"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="re_password">ยืนยันรหัสผ่าน</label>
                        <input type="password" class="form-control" id="repassword" name="repassword" >
                        <div class="error" id="div_error_repassword"></div>
                      </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="re_password">เพศ</label>
                        <div class="error" id="div_error_gender"></div>
                    </div>
                    <div class="form-group col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender" name="gender" value="male" >
                            <label class="form-check-label" for="gridRadios1">
                              ชาย
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender" name="gender" value="female" >
                            <label class="form-check-label" for="gridRadios2">
                              หญิง
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="province">จังหวัด</label>
                        <select class="form-control" id="province" name="province" >
                            <option></option>
                            @foreach ($province as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <div class="error" id="div_error_province"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="re_password">อัพโหลดรูปภาพ</label>
                        <div class="custom-file">
                            <input type="file"  id="file" name="file">
                           
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary" id="btn-save">Submit</button>
                    </div>
                </div>
         
    </form>
@endsection