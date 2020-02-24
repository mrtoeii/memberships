<script>
//    $('#firstname').keyup(function (event){
//         var pattern = /^[ก-๏\sa-zA-Z\s]+$/;
//         var input = $(this).val();
//         if(input !=''){
//             if(!input.match(pattern)){ 
//                 $('#div_error_firstname').html("กรอกตัวอักษรภาษาไทยหรือภาษาอังกฤษ กรุณากรอกใหม่อีกครั้ง");
//                 return false;
//             }else{
//                     $('#div_error_firstname').html("");
//             }
//         }
//     })
//     $('#lastname').keyup(function (event){
//         var pattern = /^[ก-๏\sa-zA-Z\s]+$/;
//         var input = $(this).val();
//         if(input !=''){
//             if(!input.match(pattern)){ 
//                 $('#div_error_lastname').html("กรอกตัวอักษรภาษาไทยหรือภาษาอังกฤษ กรุณากรอกใหม่อีกครั้ง");
//                 return false;
//             }else{
//                     $('#div_error_lastname').html("");
//             }
//         }
//     })

</script>
<div class="row">
    <div class="col-md-6">
        @if ($user->image != 'no')
             <img src="{{$user->image}}" class="img-fluid img-thumbnail">
        @else
            <img src="{{url('admin/no-avatar.png')}}" class="img-fluid img-thumbnail">
        @endif
        
        
    </div>
    <div class="col-md-6">
        <input type="hidden" name="id" id="id" value="{{$user->id}}">
        <div class="form-row">
            <div class="form-group col-md-12">
              <label for="firstname">ขื่อ</label>
                <input type="text" class="form-control" id="firstname" name="firstname"  value="{{$user->firstname}}" required>
              <div class="error" id="div_error_firstname"></div>
            </div>
            
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="lastname">นามสกุล</label>
                <input type="text" class="form-control" id="lastname" name="lastname"  value="{{$user->lastname}}" required>
                <div class="error" id="div_error_lastname"></div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="re_password">เพศ</label>
                <div class="error" id="div_error_gender"></div>
            </div>
            <div class="form-group col-md-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender" name="gender" value="male"  <?php if($user->gender=='male') { echo 'checked="checked"';} ?> required>
                    <label class="form-check-label" for="gridRadios1">
                      ชาย
                    </label>
                </div>
            </div>
            <div class="form-group col-md-2">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="gender" name="gender" value="female" <?php if($user->gender=='female') { echo 'checked="checked"';} ?> required>
                    <label class="form-check-label" for="gridRadios2">
                      หญิง
                    </label>
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="province">จังหวัด</label>
                <select class="form-control" id="province" name="province" required>
                    <option></option>
                    @foreach ($provinces as $item)
                    <option <?php if($user->province_id==$item->id) { echo 'selected="selected"';} ?>  value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
                <div class="error" id="div_error_province"></div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="re_password">อัพโหลดรูปภาพ</label>
                    <div class="custom-file">
                        <input type="file"  id="file" name="file">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
