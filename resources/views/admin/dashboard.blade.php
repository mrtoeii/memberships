@extends('layouts')

@section('title', 'Dashboard')

@section('content')
    @php
       
    @endphp
    <script> 
    $(document).on('click', '.pagination a', function(event){
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
       
    });
    function fetch_data(page)
    {
        $.ajax({
            url:"{{url('dashboard')}}?page="+page,
            success:function(data)
            {
                $('#table_data').html(data);
                $('#page').val(page)
            }
        });
    }
     $(document).ready(function(){
        $('#btn-action').click(function (){
            var page = $('#page').val()
            var formData = new FormData($('#form')[0]);
            $.ajax({
                url: '{{url("update.user")}}',
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
                    }else if(data==1){
                        alert('แก้ไขข้อมูลผู้ใช้งานเรียบร้อยแล้ว')
                        document.getElementById("form").reset();
                        $('#modal').modal('hide')
                        fetch_data(page);
                    }
                }
            });
        })
    })
    
     $('body').on('click', '#edit-user', function () {
        var user_id = $(this).data('id');
        $.ajax({
            url: '{{url("view.user")}}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id:user_id
            },
            type: 'POST',
            success: function(data){
                $('#modal').modal('show')
                $('#modal-title').html('แก้ไขข้อมูลผู้ใช้งาน')
                $('#modal-body').html(data)
                $('#btn-action').html('อัพเดท')
                $('#btn-action').val('update')
            }
        });
     });
     $('body').on('click', '#delete-user', function () {
        var user_id = $(this).data('id');
       
        var r = confirm("ยืนยันลบข้อมูลผู้ใช้งาน ? ");
        if (r == true) {
           $.ajax({
                url: '{{url("delete.user")}}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id:user_id
                },
                type: 'POST',
                success: function(data){
                    if(data==1){
                        location.reload();
                    }
                }
            });
        } 

        
     });
    </script>
   
   <div class="row">
       <div class="col-md-10">
           <h2>รายชื่อผู้ใช้งาน</h2>
       </div>
       {{-- <div class="col-md-2">
            <button type="button" class="btn btn-primary" id="btn-add">เพิ่มข้อมูลลูกค้า</button>
        </div> --}}
   </div>
   <div class="row">
        <div class="col-md-12">
            <div id="table_data">
                @include('admin.user_list')
            </div>
        </div>
    </div>
  
 
@endsection