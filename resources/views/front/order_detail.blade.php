@extends('front/layout')
@section('page_title','Order Detail')
@section('container')

    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <div class="aa-catg-head-banner-area">
            <div class="container"></div>
        </div>
    </section>
    <!-- / catg header banner section -->

    <section id="cart-view">
        <div class="container">
            <div class="row">
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
                        Trạng thái đơn hàng: {{$order_details[0]->payment_status}}<br/>
                        Hình thức thanh toán: {{$order_details[0]->payment_type}}<br/>
                    </div>
                    <b>Đơn hàng đã đến</b><br/>
                    {{$order_details[0]->track_details}}
                </div>
                <div class="col-md-12">
                    <div class="cart-view-area">
                        <div class="cart-view-table">
                            <form action="">
                                <div class="table-responsive">
                                    <table class="table">
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
                                            $totalAmt=0;
                                        @endphp
                                        @foreach($order_details as $list)
                                        @php
                                            $totalAmt = $totalAmt + ($list->price*$list->qty);
                                            // prx($list);
                                        @endphp
                                            <tr>
                                                <td>{{$list->pname}}</td>
                                                <td>
                                                    <img src='{{asset('storage/media/product/'.$list->attr_image)}}'/>
                                                </td>
                                                <td>{{$list->cover_type}}</td>
                                                <td>{{$list->price}}</td>
                                                <td>{{$list->qty}}</td>
                                                <td>{{$list->price*$list->qty}}</td>
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <td colspan="4">&nbsp;</td>
                                                <td><b>Tổng tiền</b></td>
                                                <td><b>{{$totalAmt}}</b></td>
                                            </tr>
                                            <?php
                                                if($order_details[0]->coupon_value > 0) {
                                                    echo '<tr>
                                                        <td colspan="4">&nbsp;</td>
                                                        <td><b>Mã giảm giá <span class="coupon_apply_txt">('.$order_details[0]->coupon_code.')</span></b></td>
                                                        <td>'.$order_details[0]->coupon_value.'</td>
                                                    </tr>';
                                                    $totalAmt = $totalAmt - $order_details[0]->coupon_value;
                                                    echo '<tr>
                                                        <td colspan="4">&nbsp;</td>
                                                        <td><b>Số tiền cần thanh toán</b></td>
                                                        <td>'.$totalAmt.'</td>
                                                    </tr>';
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <!-- Cart Total view -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
