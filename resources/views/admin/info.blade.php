@extends('admin/home')
@section('page_title','Thông tin')
@section('info_select','active')
@section('container')

    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-blue panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <i class="fa fa-product-hunt"></i>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">{{$count_prod}}</div>
                        <div class="text-muted">Sản phẩm</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-orange panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">{{$count_comment}}</div>
                        <div class="text-muted">Bình luận</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-teal panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">{{$count_user}}</div>
                        <div class="text-muted">Thành viên</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-3">
            <div class="panel panel-red panel-widget">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-5 widget-left">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">{{$count_order}}</div>
                        <div class="text-muted">Đơn hàng</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-banner-area">
                        <a href="#" class="ta-center">
                            <img class="img-info" src="{{asset('front_assets/img/info.gif')}}" alt="fashion banner img">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
