@extends('front/layout')
@section('page_title','Order')
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
                <div class="col-md-12">
                    <div class="cart-view-area">
                        <div class="cart-view-table">
                            <form action="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Mã đơn hàng</th>
                                                <th>Tình trạng đơn hàng</th>
                                                <th>Trạng thái đơn hàng</th>
                                                <th>Tổng tiền thanh toán</th>
                                                <th>Thời gian đặt hàng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $list)
                                            <tr>
                                                <td>
                                                    <a href="{{url('order_detail')}}/{{$list->id}}">
                                                        <div class="order_id_btn">{{$list->id}}</div>
                                                    </a>
                                                </td>

                                                <?php
                                                $total_amt = $list->total_amt - $list->coupon_value;
                                                ?>
                                                <td>{{$list->order_status}}</td>
                                                <td>{{$list->payment_status}}</td>
                                                <td>{{$total_amt}}</td>
                                                <td>{{$list->added_on}}</td>
                                            </tr>
                                        @endforeach
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
