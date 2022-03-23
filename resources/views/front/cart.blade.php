@extends('front/layout')
@section('page_title','Cart Page')
@section('container')

    <!-- catg header banner section -->
    <section id="aa-catg-head-banner">
        <div class="aa-catg-head-banner-area">
            <div class="container">
            </div>
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
                            @if(isset($list[0]))
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="mw-2"></th>
                                                <th class="mw-4"></th>
                                                <th>Sản phẩm</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th>Tổng thanh toán</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($list as $data)
                                            <tr id="cart_box{{$data->attr_id}}">
                                                <td>
                                                    <a class="remove" href="javascript:void(0)" onclick="deleteCartProduct('{{$data->pid}}','{{$data->cover_type}}','{{$data->attr_id}}')">
                                                        <fa class="fa fa-close"></fa>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{url('product/'.$data->slug)}}">
                                                        <img src="{{asset('storage/media/product/'.$data->image)}}" alt="img">
                                                    </a>
                                                </td>
                                                <td><a class="aa-cart-title" href="{{url('product/'.$data->slug)}}">{{$data->name}}</a>
                                                @if($data->cover_type != '')
                                                <br/>Loại bìa: {{$data->cover_type}}
                                                @endif
                                                </td>
                                                <td>{{$data->price}} đ</td>
                                                <td>
                                                    <input id="qty{{$data->attr_id}}" class="aa-cart-quantity" type="number" value="{{$data->qty}}" onchange="updateQty('{{$data->pid}}','{{$data->cover_type}}','{{$data->attr_id}}','{{$data->price}}')">
                                                </td>
                                                <td id="total_price_{{$data->attr_id}}">{{$data->price*$data->qty}} đ</td>
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <td colspan="6" class="aa-cart-view-bottom">
                                                    <a class="aa-cartbox-checkout aa-primary-btn" href="{{url('/checkout')}}">
                                                        <input class="aa-cart-view-btn" type="button" value="Thanh toán">
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <h3>Chưa thêm sản phẩm vào giỏ hàng</h3>
                                @endif
                            </form>
                            <!-- Cart Total view -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <input type="hidden" id="qty" value="1"/>
    <form id="frmAddToCart">
        <input type="hidden" id="cover_id" name="cover_id"/>
        <input type="hidden" id="pqty" name="pqty"/>
        <input type="hidden" id="product_id" name="product_id"/>
        @csrf
    </form>

@endsection
