@extends('front/layout')
@section('page_title','Category')
@section('container')

    <!-- product category -->
    <section id="aa-product-category">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
                    <div class="aa-product-catg-content">
                        <div class="aa-product-catg-head">
                            <div class="aa-product-catg-head-left">
                                <form action="" class="aa-sort-form">
                                    <label for="">Sắp xếp theo:</label>
                                    <select class="mr-2" name="" onchange="sort_by()" id="sort_by_value">
                                        <option value="" selected="Default">Trống</option>
                                        <option value="name">Tên</option>
                                        <option value="price_desc">Giá giảm dần</option>
                                        <option value="price_asc">Giá tăng dần</option>
                                        <option value="date">Ngày</option>
                                    </select>
                                </form>
                                {{$sort_txt}}
                            </div>
                            <div class="aa-product-catg-head-right">
                                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
                            </div>
                        </div>
                        <div class="aa-product-catg-body">
                            <ul class="aa-product-catg">
                            <!-- start single product item -->
                            @if(isset($product[0]))
                            @foreach($product as $productArr)
                                <li>
                                    <figure>
                                        <a class="aa-product-img" href="{{url('product/'.$productArr->slug)}}">
                                            <img src="{{asset('storage/media/product/'.$productArr->image)}}" alt="{{$productArr->name}}" width="250px">
                                        </a>
                                        <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{$productArr->id}}','{{$product_attr[$productArr->id][0]->cover_type}}')">
                                            <span class="fa fa-shopping-cart"></span>Thêm vào giỏ hàng
                                        </a>
                                        <figcaption>
                                            <h4 class="aa-product-title">
                                                <a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a>
                                            </h4>
                                            <span class="aa-product-price">{{$product_attr[$productArr->id][0]->price}} đ</span>
                                            <span class="aa-product-price">
                                                <del>{{$product_attr[$productArr->id][0]->mrp}} đ</del>
                                            </span>
                                        </figcaption>
                                    </figure>
                                </li>
                            @endforeach
                            @else
                                <li>
                                    <figure>Không có sản phẩm để hiển thị<figure>
                                <li>
                            @endif
                            </ul>
                            <!-- quick view modal -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
                    <aside class="aa-sidebar">
                    <!-- single sidebar -->
                        <div class="aa-sidebar-widget">
                            <h3>Thể loại</h3>
                            <ul class="aa-catg-nav">
                            @foreach($categories_left as $cat_left)
                            @if($slug == $cat_left->category_slug)
                                <li>
                                    <a href="{{url('category/'.$cat_left->category_slug)}}" class="left_cat_active">{{$cat_left->category_name}}</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{url('category/'.$cat_left->category_slug)}}">{{$cat_left->category_name}}</a>
                                </li>
                            @endif
                            @endforeach
                            </ul>
                        </div>
                        <div class="aa-sidebar-widget">
                            <h3>Tìm kiếm theo giá</h3>
                            <!-- price range -->
                            <div class="aa-sidebar-price-range">
                                <form action="">
                                    <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background"></div>
                                    <span id="skip-value-lower" class="example-val"></span>
                                    <span id="skip-value-upper" class="example-val"></span>
                                    <button class="aa-filter-btn mt-s" type="button" onclick="sort_price_filter()">Tìm kiếm</button>
                                </form>
                            </div>
                        </div>
                        <!-- single sidebar -->
                        <h4 class="mt-cv">Tìm kiếm theo loại bìa</h4>
                        <div class="category-view-cover">
                        @foreach($covers as $cover)
                        @if($cover!='')
                            <a href="javascript:void(0)" onclick="sort_cover('{{$cover->id}}')" id="cover_{{$cover->cover_type}}" class="cover_link">{{$cover->cover_type}}</a>
                        @endif
                        @endforeach
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- / product category -->

    <input type="hidden" id="qty" value="1"/>
    <form id="frmAddToCart">
        <input type="hidden" id="cover_id" name="cover_id"/>
        <input type="hidden" id="pqty" name="pqty"/>
        <input type="hidden" id="product_id" name="product_id"/>
        @csrf
    </form>
    <form id="categoryFilter">
        <input type="hidden" id="sort" name="sort" value="{{$sort}}"/>
        <input type="hidden" id="filter_price_start" name="filter_price_start" value="{{$filter_price_start}}"/>
        <input type="hidden" id="filter_price_end" name="filter_price_end" value="{{$filter_price_end}}"/>
        <input type="hidden" id="cover_filter" name="cover_filter" value="{{$cover_filter}}"/>
    </form>

@endsection
