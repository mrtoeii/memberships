<input type="hidden" id="page">
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">ชื่อ</th>
            <th scope="col">สกุล</th>
            <th scope="col">เพศ</th>
            <th scope="col" colspan="3">จังหวัด</th>
        </tr>
    </thead>
    <tbody>
        @if ($users->count()>0)
            <?php
                foreach ($users as $item) {
                    $province_name = '';
                    $gender = '';
                    foreach ($provinces as $value) {
                        if($item->province_id==$value->id){
                        $province_name =$value->name;
                        }
                    }
                    if($item->gender=='male'){
                        $gender = 'ชาย';
                    }else if($item->gender=='female'){
                        $gender = 'หญิง';
                    }
            ?>
            <tr>
                <td>{{$item->firstname}}</td>
                <td>{{$item->lastname}}</td>
                <td>{{$gender}}</td>
                <td>{{$province_name}}</td>
                <td>
                    <a href="javascript:void(0)" id="edit-user" data-id="{{$item->id}}" class="btn btn-info btn-sm">แก้ไข</a>
                    <a href="javascript:void(0)" id="delete-user" data-id="{{ $item->id }}" class="btn btn-danger btn-sm">ลบ</a>
                </td>
            </tr> 
        <?php
             }
        ?>
        @else
            <tr>
                <td colspan="4" class="no-data">ไม่มีข้อมูล</td>
            <tr>
        @endif
</table>
{!! $users->links() !!}