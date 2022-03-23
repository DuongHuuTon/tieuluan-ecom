@extends('front/layout')
@section('page_title','Checkout')
@section('container')

    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <div class="aa-catg-head-banner-area">
            <div class="container"></div>
        </div>
    </section>
    <!-- / catg header banner section -->
    <section id="checkout">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="checkout-area">
                        <form id="frmPlaceOrder">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="checkout-left">
                                        <div class="panel-group" id="accordion">
                                        <!-- Shipping Address -->
                                            <div class="panel panel-default aa-checkout-billaddress">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion">Thông tin khách hàng</a>
                                                    </h4>
                                                </div>
                                                <div id="collapseFour" class="panel-collapse collapse in">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="text" placeholder="Nhập họ tên" value="{{$users['name']}}" name="name" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="email" placeholder="Nhập địa chỉ Email" value="{{$users['email']}}" name="email" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="aa-checkout-single-bill">
                                                                    <input type="tel" placeholder="Nhập số điện thoại" value="{{$users['phone']}}" name="phone" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="aa-checkout-single-bill">
                                                                    <textarea cols="8" rows="3" name="address" required placeholder="Nhập địa chỉ">{{$users['address']}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="checkout-right">
                                    <h4>Tổng thanh toán</h4>
                                        <div class="aa-order-summary-area">
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                    <th>Sản phẩm</th>
                                                    <th>Số tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $totalPrice=0;
                                                @endphp
                                                @foreach($cart_data as $list)
                                                @php
                                                    $totalPrice = $totalPrice + ($list->price*$list->qty)
                                                @endphp
                                                    <tr>
                                                        <td>{{$list->name}}  <strong> x  {{$list->qty}}</strong>
                                                            <br/>
                                                            <span class="cart_color">{{$list->cover_type}}</span>
                                                        </td>
                                                        <td>{{$list->price*$list->qty}} đ</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr class="hide show_coupon_box">
                                                        <th>Mã giảm giá
                                                            <a href="javascript:void(0)" onclick="remove_coupon_code()" class="remove_coupon_code_link">Hủy</a>
                                                        </th>
                                                        <td id="coupon_code_str"></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Tổng tiền</th>
                                                        <td id="total_price">{{$totalPrice}} đ</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <h4>Mã giảm giá</h4>
                                        <div class="aa-payment-method coupon_code">
                                            <input type="text" placeholder="Nhập mã giảm giá" class="aa-coupon-code apply_coupon_code_box" name="coupon_code" id="coupon_code">
                                            <input type="button" value="Áp dụng" class="aa-browse-btn apply_coupon_code_box" onclick="applyCouponCode()">
                                            <div id="coupon_code_msg"></div>
                                        </div>
                                        <br/>
                                        <h4>Phương thức thanh toán</h4>
                                        <div class="aa-payment-method">
                                            <label for="cod">
                                                <input type="radio" id="cod" name="payment_type" value="COD" checked> Thanh toán khi nhận hàng
                                            </label>
                                            <input type="submit" value="Đặt hàng" class="aa-browse-btn" id="btnPlaceOrder">
                                        </div>
                                        <div id="order_place_msg"></div>
                                    </div>
                                </div>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
