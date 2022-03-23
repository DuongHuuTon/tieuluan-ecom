@extends('admin/home')
@section('page_title','Sản phẩm')
@section('product_select','active')
@section('container')

    @if(session()->has('message'))
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    <h1 class="mb10 fs-3">Sản phẩm</h1>
    <a href="{{url('admin/product/manage_product')}}">
        <button type="button" class="btn btn-success">Thêm sản phẩm</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Mã số</th>
                            <th>Tên</th>
                            <th>Đường dẫn tĩnh</th>
                            <th>Hình ảnh</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->name}}</td>
                            <td>{{$list->slug}}</td>
                            <td>
                            @if($list->image != '')
                                <img width="100px" src="{{asset('storage/media/product/'.$list->image)}}"/>
                            @endif
                            </td>
                            <td>
                                <a href="{{url('admin/product/manage_product/')}}/{{$list->id}}"><button type="button" class="btn btn-success">Chỉnh sửa</button></a>

                                @if($list->status == 1)
                                    <a href="{{url('admin/product/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-primary">Ẩn</button></a>
                                @elseif($list->status == 0)
                                    <a href="{{url('admin/product/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-warning">Hiện</button></a>
                                @endif

                                <a href="{{url('admin/product/delete/')}}/{{$list->id}}"><button type="button" class="btn btn-danger">Xóa</button></a>
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
