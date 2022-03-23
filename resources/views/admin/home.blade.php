<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('page_title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('admin_assets/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('admin_assets/css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body>

    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo ml-4" href="{{url('admin/info')}}">
                            <img src="{{asset('admin_assets/images/icon/logo.png')}}" alt="CoolAdmin" width="100px" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="@yield('info_select')">
                            <a href="{{url('admin/info')}}">
                                <i class="fas fa-tachometer-alt w-20ml"></i>Thông tin
                            </a>
                        </li>
                        <li class="@yield('user_select')">
                            <a href="{{url('admin/user')}}">
                                <i class="fa fa-user w-20ml"></i>Người dùng
                            </a>
                        </li>
                        <li class="@yield('order_select')">
                            <a href="{{url('admin/order')}}">
                                <i class="fas fa-shopping-basket w-20ml"></i>Đơn đặt hàng
                            </a>
                        </li>
                        <li class="@yield('product_review_select')">
                            <a href="{{url('admin/product_review')}}">
                                <i class="fas fa-star w-20ml"></i>Đánh giá sản phẩm
                            </a>
                        </li>
                        <li class="@yield('category_select')">
                            <a href="{{url('admin/category')}}">
                                <i class="fas fa-list w-20ml"></i>Danh mục
                            </a>
                        </li>
                        <li class="@yield('coupon_select')">
                            <a href="{{url('admin/coupon')}}">
                                <i class="fas fa-tag w-20ml"></i>Mã giảm giá
                            </a>
                        </li>
                        <li class="@yield('cover_select')">
                            <a href="{{url('admin/cover')}}">
                                <i class="fas fa-book w-20ml"></i>Bìa sách
                            </a>
                        </li>
                        <li class="@yield('publisher_select')">
                            <a href="{{url('admin/publisher')}}">
                                <i class="fas fa-upload w-20ml"></i>Nhà xuất bản
                            </a>
                        </li>
                        <li class="@yield('tax_select')">
                            <a href="{{url('admin/tax')}}">
                                <i class="fas fa-percent w-20ml"></i>Thuế
                            </a>
                        </li>
                        <li class="@yield('product_select')">
                            <a href="{{url('admin/product')}}">
                                <i class="fa fa-product-hunt w-20ml"></i>Sản phẩm
                            </a>
                        </li>
                        <li class="@yield('home_banner_select')">
                            <a href="{{url('admin/home_banner')}}">
                                <i class="fas fa-images w-20ml"></i>Ảnh trang chủ
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo ml-3">
                <a href="{{url('admin/info')}}">
                    <img src="{{asset('admin_assets/images/icon/logo.png')}}" width="100px" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="@yield('info_select')">
                            <a href="{{url('admin/info')}}">
                                <i class="fas fa-tachometer-alt w-20ml"></i>Thông tin
                            </a>
                        </li>
                        <li class="@yield('user_select')">
                            <a href="{{url('admin/user')}}">
                                <i class="fa fa-user w-20ml"></i>Người dùng
                            </a>
                        </li>
                        <li class="@yield('order_select')">
                            <a href="{{url('admin/order')}}">
                                <i class="fas fa-shopping-basket w-20ml"></i>Đơn đặt hàng
                            </a>
                        </li>
                        <li class="@yield('product_review_select')">
                            <a href="{{url('admin/product_review')}}">
                                <i class="fas fa-star w-20ml"></i>Đánh giá sản phẩm
                            </a>
                        </li>
                        <li class="@yield('category_select')">
                            <a href="{{url('admin/category')}}">
                                <i class="fas fa-list w-20ml"></i>Danh mục
                            </a>
                        </li>
                        <li class="@yield('coupon_select')">
                            <a href="{{url('admin/coupon')}}">
                                <i class="fas fa-tag w-20ml"></i>Mã giảm giá
                            </a>
                        </li>
                        <li class="@yield('cover_select')">
                            <a href="{{url('admin/cover')}}">
                                <i class="fas fa-book w-20ml"></i>Bìa sách
                            </a>
                        </li>
                        <li class="@yield('publisher_select')">
                            <a href="{{url('admin/publisher')}}">
                                <i class="fas fa-upload w-20ml"></i>Nhà xuất bản
                            </a>
                        </li>
                        <li class="@yield('tax_select')">
                            <a href="{{url('admin/tax')}}">
                                <i class="fas fa-percent w-20ml"></i>Thuế
                            </a>
                        </li>
                        <li class="@yield('product_select')">
                            <a href="{{url('admin/product')}}">
                                <i class="fa fa-product-hunt w-20ml"></i>Sản phẩm
                            </a>
                        </li>
                        <li class="@yield('home_banner_select')">
                            <a href="{{url('admin/home_banner')}}">
                                <i class="fas fa-images w-20ml"></i>Ảnh trang chủ
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST"></form>
                            <div class="header-button">
                                <div class="account-wrap">
                                    <x-app-layout></x-app-layout>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- END HEADER DESKTOP-->
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        @section('container')
                        @show
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTAINER-->
        </div>
    </div>

    <!-- Jquery JS -->
    <script src="{{asset('admin_assets/vendor/jquery-3.2.1.min.js')}}"></script>

    <!-- Bootstrap JS -->
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>

    <!-- Vendor JS -->
    <script src="{{asset('admin_assets/vendor/wow/wow.min.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('admin_assets/js/main.js')}}"></script>

</body>

</html>
