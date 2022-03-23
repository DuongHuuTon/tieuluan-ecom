@extends('admin/home')
@section('page_title','Đánh giá sản phẩm')
@section('product_review_select','active')
@section('container')

    <h1 class="mb10 fs-3">Đánh giá sản phẩm</h1>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Mã số</th>
                            <th>Tên khách hàng</th>
                            <th>Tên sản phẩm</th>
                            <th>Đánh giá</th>
                            <th>Bình luận</th>
                            <th>Thời gian đánh giá</th>
                            <th>hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $list)
                        <tr>
                            <td>{{$list->id}}</td>
                            <td>{{$list->name}}</td>
                            <td>{{$list->pname}}</td>
                            <td>{{$list->rating}}</td>
                            <td>{{$list->review}}</td>
                            <td>{{getCustomDate($list->added_on)}}</td>
                            <td>
                                @if($list->status == 1)
                                    <a href="{{url('admin/update_product_review_status/0')}}/{{$list->id}}">
                                        <button type="button" class="btn btn-primary">Hiện</button>
                                    </a>
                                @elseif($list->status == 0)
                                    <a href="{{url('admin/update_product_review_status/1')}}/{{$list->id}}">
                                        <button type="button" class="btn btn-warning">Ẩn</button>
                                    </a>
                                @endif
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
