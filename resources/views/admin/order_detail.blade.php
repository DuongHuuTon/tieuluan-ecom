@extends('admin/home')
@section('page_title','Chi tiết đơn hàng')
@section('order_select','active')
@section('container')

    <h1 class="mb10 fs-3">Đơn hàng -  {{$order_details[0]->id}}</h1>
    <div class="order_operation">
        <b>Cập nhật tình trạng đơn hàng</b>
        <select class="form-control m-b-10" id="order_status" onchange="update_order_status({{$order_details[0]->id}})">
        <?php
        foreach($order_statuses as $list) {
            if($order_details[0]->order_order_status_id == $list->id) {
                echo "<option value='".$list->id."' selected>".$list->order_status."</option>";
            }else{
                echo "<option value='$list->id'>".$list->order_status."</option>";
            }
        }
        ?>
        </select>
        <b>Cập nhật trạng thái đơn hàng</b>
        <select class="form-control  m-b-10" id="payment_status" onchange="update_payment_status({{$order_details[0]->id}})">
        <?php
        foreach($payment_status as $list) {
            if($order_details[0]->payment_status == $list) {
                echo "<option value='$list' selected>$list</option>";
            }else{
                echo "<option value='$list'>$list</option>";
            }
        }
        ?>
        </select>
        <b>Đơn hàng đã đến</b>
        <form method="post">
            <textarea name="track_details" class="form-control  m-b-10" required>{{$order_details[0]->track_details}}</textarea>
            <button type="submit" class="btn btn-success">Update</button>
        @csrf
        </form>
    </div>
    <div class="row m-t-30 whitebg">
        <div class="col-md-6">
            <div class="order_detail">
                <h3>Thông tin khách hàng</h3>
                {{$order_details[0]->name}}({{$order_details[0]->phone}}) <br/>{{$order_details[0]->address}}<br/>
            </div>
        </div>
    <div class="col-md-6">
        <div class="order_detail">
            <h3>Chi tiết đơn hàng</h3>
            Tình trạng đơn hàng: {{$order_details[0]->order_status}}<br/>
            Trạng thái thanh toán: {{$order_details[0]->payment_status}}<br/>
            Hình thức thanh toán: {{$order_details[0]->payment_type}}<br/>
        </div>
    </div>
    <div class="col-md-12">
        <div class="cart-view-area">
            <div class="cart-view-table">
                <div class="table-responsive">
                    <table class="table order_detail">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Loại bìa</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $totalAmt = 0;
                        @endphp
                        @foreach($order_details as $list)
                        @php
                            $totalAmt = $totalAmt + ($list->price*$list->qty);
                        @endphp
                        <tr>
                            <td>{{$list->pname}}</td>
                            <td>
                                <img src='{{asset('storage/media/product/'.$list->attr_image)}}'/>
                            </td>
                            <td>{{$list->cover_type}}</td>
                            <td>{{$list->price}} đ</td>
                            <td>{{$list->qty}}</td>
                            <td>{{$list->price*$list->qty}} đ</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="5">&nbsp;</td>
                            <td><b>Tổng tiền</b></td>
                            <td><b>{{$totalAmt}} đ</b></td>
                        </tr>
                        <?php
                            if($order_details[0]->coupon_value > 0) {
                                echo '<tr>
                                    <td colspan="5">&nbsp;</td>
                                    <td><b>Mã giảm giá<span class="coupon_apply_txt">('.$order_details[0]->coupon_code.')</span></b></td>
                                    <td>'.$order_details[0]->coupon_value.'</td>
                                </tr>';
                                $totalAmt = $totalAmt - $order_details[0]->coupon_value;
                                echo '<tr>
                                    <td colspan="5">&nbsp;</td>
                                    <td><b>Số tiền cần thanh toán</b></td>
                                    <td>'.$totalAmt.' đ</td>
                                </tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
                <!-- Cart Total view -->
		    </div>
        </div>
    </div>

@endsection
