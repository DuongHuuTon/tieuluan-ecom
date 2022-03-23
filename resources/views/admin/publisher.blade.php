@extends('admin/home')
@section('page_title','Nhà xuất bản')
@section('publisher_select','active')
@section('container')

    @if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    <h1 class="mb10 fs-3">Nhà xuất bản</h1>
    <a href="{{url('admin/publisher/manage_publisher')}}">
        <button type="button" class="btn btn-success">Thêm nhà xuất bản</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Mã số</th>
                            <th>Tên nhà xuất bản</th>
                            <th>Hình ảnh</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->name}}</td>
                            <td>
                            @if($list->image != '')
                                <img width="100px" src="{{asset('storage/media/publisher/'.$list->image)}}"/>
                            @endif
                            </td>
                            <td>
                                <a href="{{url('admin/publisher/manage_publisher/')}}/{{$list->id}}"><button type="button" class="btn btn-success">Chỉnh sửa</button></a>

                                @if($list->status == 1)
                                    <a href="{{url('admin/publisher/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Hoạt động</button></a>
                                @elseif($list->status == 0)
                                    <a href="{{url('admin/publisher/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Không hoạt động</button></a>
                                @endif

                                <a href="{{url('admin/publisher/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Xóa</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>

@endsection
