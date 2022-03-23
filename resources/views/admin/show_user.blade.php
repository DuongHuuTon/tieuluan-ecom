@extends('admin/home')
@section('page_title','Thông tin người dùng')
@section('user_select','active')
@section('container')

    <h1 class="mb10 fs-3">Thông tin người dùng</h1>
    <div class="row m-t-30">
        <div class="col-md-8">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <tbody>
                        <tr>
                            <td><strong>Tên người dùng</strong></td>
                            <td>{{$user_list->name}}</td>
                        </tr>
                        <tr>
                            <td><strong>Địa chỉ Email</strong></td>
                            <td>{{$user_list->email}}</td>
                        </tr>
                        <tr>
                            <td><strong>Số điện thoại</strong></td>
                            <td>{{$user_list->phone}}</td>
                        </tr>
                        <tr>
                            <td><strong>Địa chỉ</strong></td>
                            <td>{{$user_list->address}}</td>
                        </tr>
                        <tr>
                            <td><strong>Ngày tạo</strong></td>
                            <td>{{$user_list->created_at}}</td>
                        </tr>
                        <tr>
                            <td><strong>Ngày cập nhật</strong></td>
                            <td>{{$user_list->updated_at}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>

@endsection
