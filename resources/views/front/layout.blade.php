<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title')</title>

    <link href="{{asset('front_assets/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('front_assets/css/bootstrap.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('front_assets/css/jquery.smartmenus.bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('front_assets/css/sequence-theme.modern-slide-in.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('front_assets/css/style.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/jquery.simpleLens.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/nouislider.css')}}">

    <link id="switcher" href="{{asset('front_assets/css/theme-color/default-theme.css')}}" rel="stylesheet">

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>

    <script>
        var PRODUCT_IMAGE="{{asset('storage/media/product/')}}";
    </script>

</head>

<body class="productPage">

    <!-- wpf loader Two -->
    <div id="wpf-loader-two">
        <div class="wpf-loader-two-inner">
            <span>Đang khởi tạo</span>
        </div>
    </div>
    <!-- / wpf loader Two -->
    <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#">
        <i class="fa fa-chevron-up"></i>
    </a>
    <!-- END SCROLL TOP BUTTON -->
    <!-- Start header section -->
    <header id="aa-header">
    <!-- start header top  -->
        <div class="aa-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-header-top-area">
                        <!-- start header top left -->
                            <div class="aa-header-top-left">
                            <!-- start cellphone -->
                                <div class="cellphone hidden-xs">
                                    <p>
                                        <span class="fa fa-phone"></span>0834-959-800
                                    </p>
                                </div>
                            <!-- / cellphone -->
                            </div>
                        <!-- / header top left -->
                            <div class="aa-header-top-right">
                                <ul class="aa-head-top-nav-right">
                                    <li>
                                        <a href="{{url('/cart')}}">Giỏ hàng</a>
                                    </li>
                                    @if (Route::has('login'))
                                    @auth
                                        <li>
                                            <a href="{{url('/order')}}">Thông tin đơn hàng</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/user_info') }}" >Tài khoản</a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('login') }}">Đăng nhập</a>
                                        </li>
                                        @if (Route::has('register'))
                                        <li>
                                            <a href="{{ route('register') }}">Đăng ký</a>
                                        </li>
                                        @endif
                                    @endauth
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / header top  -->
        <!-- start header bottom  -->
        <div class="aa-header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-header-bottom-area">
                        <!-- logo  -->
                            <div class="aa-logo">
                        <!-- Text based logo -->
                                <a href="{{url('/')}}">
                                    <img src="{{asset('front_assets/img/logo.png')}}" width="200px">
                                </a>
                            </div>
                            <!-- cart box -->
                            @php
                                $getAddToCartTotalItem=getAddToCartTotalItem();
                                $totalCartItem=count($getAddToCartTotalItem);
                                $totalPrice=0;
                            @endphp
                            <div class="aa-cartbox">
                                <a class="aa-cart-link" href="{{url('/cart')}}" id="cartBox">
                                    <span class="fa fa-shopping-basket"></span>
                                    <span class="aa-cart-title">GIỎ HÀNG</span>
                                    <span class="aa-cart-notify">{{$totalCartItem}}</span>
                                </a>
                                <div class="aa-cartbox-summary">
                                @if($totalCartItem>0)
                                    <ul>
                                    @foreach($getAddToCartTotalItem as $cartItem)
                                    @php
                                        $totalPrice=$totalPrice+($cartItem->qty*$cartItem->price)
                                    @endphp
                                        <li>
                                            <a class="aa-cartbox-img" href="#">
                                                <img src="{{asset('storage/media/product/'.$cartItem->image)}}" alt="img">
                                            </a>
                                            <div class="aa-cartbox-info">
                                                <h4>
                                                    <a href="#">{{$cartItem->name}}</a>
                                                </h4>
                                                <p>{{$cartItem->qty}} * {{$cartItem->price}} đ</p>
                                            </div>
                                        </li>
                                    @endforeach
                                        <li>
                                            <span class="aa-cartbox-total-title">Tổng tiền</span>
                                            <span class="aa-cartbox-total-price">{{$totalPrice}} đ</span>
                                        </li>
                                    </ul>
                                @endif
                                </div>
                            </div>
                        <!-- / cart box -->
                        <!-- search box -->
                            <div class="aa-search-box">
                                <form action="">
                                    <input type="text" id="search_str" placeholder="Nhập từ khóa tìm kiếm">
                                    <button type="button" onclick="funSearch()">
                                        <span class="fa fa-search"></span>
                                    </button>
                                </form>
                            </div>
                        <!-- / search box -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- / header bottom  -->
    </header>
    <!-- / header section -->
    <!-- menu -->
    <section id="menu">
        <div class="container">
            <div class="menu-area">
            <!-- Navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Thể loại sách</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse">
                    <!-- Left nav -->
                        {!! getTopNavCat() !!}
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
    </section>
    <!-- / menu -->
    <!-- Start slider -->
    @section('container')
    @show
    <!-- footer -->
    <footer id="aa-footer">
    <!-- footer bottom -->

        <div class="aa-footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-footer-top-area">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 al ta-center">
                                    <div class="aa-footer-widget">
                                        <a href="{{asset('#')}}"><img src="{{asset('front_assets/img/logo-footer.png')}}"></a>
                                    </div>
                                </div>
                                <div class="col-md-offset-2 col-sm-6">
                                    <div class="aa-footer-widget">
                                        <div class="aa-footer-widget">
                                            <h3>Liên hệ chúng tôi</h3>
                                            <address>
                                                <p>Khu II, đường 3/2, P. Xuân Khánh, Q. Ninh Kiều, TP. Cần Thơ.</p>
                                                <p><span class="fa fa-phone"></span>+84 0834-959-800</p>
                                                <p><span class="fa fa-envelope"></span>dhton1998@gmail.com</p>
                                            </address>
                                            <div class="aa-footer-social">
                                                <a href="#"><span class="fa fa-facebook"></span></a>
                                                <a href="#"><span class="fa fa-twitter"></span></a>
                                                <a href="#"><span class="fa fa-google-plus"></span></a>
                                                <a href="#"><span class="fa fa-youtube"></span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer-bottom -->
        <div class="aa-footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="aa-footer-bottom-area">
                            <div class="aa-footer-payment">
                                <span class="fa fa-cc-mastercard"></span>
                                <span class="fa fa-cc-visa"></span>
                                <span class="fa fa-paypal"></span>
                                <span class="fa fa-cc-discover"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- / footer -->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{asset('front_assets/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/jquery.smartmenus.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/jquery.smartmenus.bootstrap.js')}}"></script>
    <script src="{{asset('front_assets/js/sequence.js')}}"></script>
    <script src="{{asset('front_assets/js/sequence-theme.modern-slide-in.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/jquery.simpleGallery.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/jquery.simpleLens.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/slick.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/nouislider.js')}}"></script>
    <script src="{{asset('front_assets/js/custom.js')}}"></script>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function() {
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/617d47eff7c0440a5920b4f5/1fj8m20tp';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        } )
        ();
    </script>
    <!--End of Tawk.to Script-->

</body>

</html>
