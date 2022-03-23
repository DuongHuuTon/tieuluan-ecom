@extends('front/layout')
@section('page_title','Order Placed')
@section('container')

    <!-- product category -->
    <section id="aa-product-category">
        <div class="container">
            <div class="row" style="text-align:center;">
                <br/><br/><br/>
                <h2>Bạn đã đặt hàng thành công!</h2>
                <h2>Mã đơn hàng:- {{session()->get('ORDER_ID')}}</h2>
                <br/><br/><br/>
            </div>
        </div>
    </section>

@endsection



