@extends('admin/home')
@section('page_title','Đơn đặt hàng')
@section('order_select','active')
@section('container')

    <h1 class="mb10 fs-3">Đơn đặt hàng</h1>
    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Thông tin khách hàng</th>
                            <th>Tổng thanh toán</th>
                            <th>Tình trạng đơn hàng</th>
                            <th>Trạng thái đơn hàng</th>
                            <th>Hình thức thanh toán</th>
                            <th>Thời gian nhận đơn hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $list)
                        <tr>
                            <td>
                                <a href="{{url('/admin/order_detail')}}/{{$list->id}}"><div class="order_id_btn">{{$list->id}}</div></a>
                            </td>
                            <td>
                                {{$list->name}}<br/>
                                {{$list->email}}<br/>
                                {{$list->phone}}<br/>
                                {{$list->address}}
                            </td>
                            <td>{{$list->total_amt}}</td>
                            <td>{{$list->order_status}}</td>
                            <td>{{$list->payment_status}}</td>
                            <td>{{$list->payment_type}}</td>
                            <td>{{$list->added_on}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>

@endsection
