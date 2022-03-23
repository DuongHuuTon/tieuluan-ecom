@extends('admin/home')
@section('page_title','Danh mục sản phẩm')
@section('category_select','active')
@section('container')

    @if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    <h1 class="mb10 fs-3">Danh mục sản phẩm</h1>
    <a href="{{url('admin/category/manage_category')}}">
        <button type="button" class="btn btn-success">Thêm danh mục</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Mã danh mục</th>
                            <th>Tên danh mục</th>
                            <th>Đường dẫn tĩnh</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->category_name}}</td>
                            <td>{{$list->category_slug}}</td>
                            <td>
                                <a href="{{url('admin/category/manage_category/')}}/{{$list->id}}"><button type="button" class="btn btn-success">Chỉnh sửa</button></a>

                                @if($list->status == 1)
                                    <a href="{{url('admin/category/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Hiện</button></a>
                                @elseif($list->status == 0)
                                    <a href="{{url('admin/category/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Ẩn</button></a>
                                @endif

                                <a href="{{url('admin/category/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Xóa</button></a>
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
