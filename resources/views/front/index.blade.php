@extends('front/layout')
@section('page_title','Home Page')
@section('container')

    <section id="aa-slider">
        <div class="aa-slider-area">
            <div id="sequence" class="seq">
                <div class="seq-screen">
                    <ul class="seq-canvas">
                    <!-- single slide item -->
                    @foreach($home_banner as $list)
                        <li>
                            <div class="seq-model">
                                <img data-seq src="{{asset('storage/media/banner/'.$list->image)}}" />
                            </div>
                            @if($list->btn_txt != '')
                            <div class="seq-title">
                                <a data-seq target="_blank" href="{{$list->btn_link}}" class="aa-shop-now-btn aa-secondary-btn">{{$list->btn_txt}}</a>
                            </div>
                            @endif
                        </li>
                    @endforeach
                    </ul>
                </div>
                <!-- slider navigation btn -->
                <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
                    <a type="button" class="seq-prev" aria-label="Previous">
                        <span class="fa fa-angle-left"></span>
                    </a>
                    <a type="button" class="seq-next" aria-label="Next">
                        <span class="fa fa-angle-right"></span>
                    </a>
                </fieldset>
            </div>
        </div>
    </section>
    <!-- / slider -->
    <!-- Products section -->
    <section id="aa-product">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="aa-product-area">
                            <div class="aa-product-inner">
                            <!-- start prduct navigation -->
                                <h3 class="ta-center"><b>Thể loại</b></h3>
                                <ul class="nav nav-tabs aa-products-tab">
                                @foreach($home_categories as $list)
                                    <li class="">
                                        <a href="#cat{{$list->id}}" data-toggle="tab">{{$list->category_name}}</a>
                                    </li>
                                @endforeach
                                </ul>
                            <!-- Tab panes -->
                                <div class="tab-content">
                                <!-- Start men product category -->
                                    @php
                                        $loop_count = 1;
                                    @endphp
                                    @foreach($home_categories as $list)
                                    @php
                                        $cat_class = "";
                                        if($loop_count == 1){
                                            $cat_class="in active";
                                            $loop_count++;
                                        }
                                    @endphp
                                    <div class="tab-pane fade {{$cat_class}}" id="cat{{$list->id}}">
                                        <ul class="aa-product-catg">
                                        @if(isset($home_categories_product[$list->id][0]))
                                            @foreach($home_categories_product[$list->id] as $productArr)
                                            <li>
                                                <figure>
                                                    <a class="aa-product-img" href="{{url('product/'.$productArr->slug)}}">
                                                        <img src="{{asset('storage/media/product/'.$productArr->image)}}" alt="{{$productArr->name}}" width="250px">
                                                    </a>
                                                    <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{$productArr->id}}','{{$home_product_attr[$productArr->id][0]->cover_type}}')">
                                                        <span class="fa fa-shopping-cart"></span>Thêm vào giỏ hàng
                                                    </a>
                                                        <span class="fa fa-shopping-cart"></span>Thêm vào giỏ hàng
                                                    </a>
                                                <figcaption>
                                                    <h4 class="aa-product-title">
                                                        <a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a>
                                                    </h4>
                                                    <span class="aa-product-price">{{$home_product_attr[$productArr->id][0]->price}} đ</span>
                                                    <span class="aa-product-price">
                                                        <?php
                                                        if($home_product_attr[$productArr->id][0]->mrp != 0) {
                                                        ?>
                                                            <del>{{$home_product_attr[$productArr->id][0]->mrp}} đ</del>
                                                        <?php
                                                        }
                                                        ?>
                                                    </span>
                                                </figcaption>
                                                </figure>
                                            </li>
                                            @endforeach
                                        @else
                                            <li>
                                                <figure>Không có sản phẩm để hiển thị</figure>
                                            </li>
                                        @endif
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Products section -->
    <!-- banner section -->
    <section id="aa-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="aa-banner-area">
                            <a href="#" class="ta-center">
                                <img src="{{asset('front_assets/img/banner.gif')}}" alt="fashion banner img" width="800px" height="400px">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- popular section -->
    <section id="aa-popular-category">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="aa-popular-category-area">
                        <!-- start prduct navigation -->
                            <ul class="nav nav-tabs aa-products-tab">
                                <li class="active">
                                    <a href="#featured" data-toggle="tab">Sách nổi bật</a>
                                </li>
                                <li>
                                    <a href="#tranding" data-toggle="tab">Sách xu hướng</a>
                                </li>
                                <li>
                                    <a href="#discounted" data-toggle="tab">Sách giảm giá</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                            <!-- Start men featured category -->
                                <div class="tab-pane fade in active" id="featured">
                                    <ul class="aa-product-catg aa-featured-slider">
                                    <!-- start single product item -->
                                    @if(isset($home_featured_product[$list->id][0]))
                                    @foreach($home_featured_product[$list->id] as $productArr)
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="{{url('product/'.$productArr->slug)}}">
                                                    <img src="{{asset('storage/media/product/'.$productArr->image)}}" alt="{{$productArr->name}}" width="250px">
                                                </a>
                                                <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{$productArr->id}}','{{$home_product_attr[$productArr->id][0]->cover_type}}')">
                                                    <span class="fa fa-shopping-cart"></span>Thêm vào giỏ hàng
                                                </a>
                                                    <span class="fa fa-shopping-cart"></span>Thêm vào giỏ hàng
                                                </a>
                                                <figcaption>
                                                    <h4 class="aa-product-title">
                                                        <a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a>
                                                    </h4>
                                                    <span class="aa-product-price">{{$home_featured_product_attr[$productArr->id][0]->price}} đ</span>
                                                    <span class="aa-product-price">
                                                    <?php
                                                    if($home_product_attr[$productArr->id][0]->mrp != 0) {
                                                    ?>
                                                        <del>{{$home_product_attr[$productArr->id][0]->mrp}} đ</del>
                                                    <?php
                                                    }
                                                    ?>
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
                                </div>
                                <!-- / popular product category -->
                                <!-- start tranding product category -->
                                <div class="tab-pane fade" id="tranding">
                                    <ul class="aa-product-catg aa-featured-slider">
                                    <!-- start single product item -->
                                    @if(isset($home_trending_product[$list->id][0]))
                                    @foreach($home_trending_product[$list->id] as $productArr)
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="{{url('product/'.$productArr->slug)}}">
                                                    <img src="{{asset('storage/media/product/'.$productArr->image)}}" alt="{{$productArr->name}}" width="250px">
                                                </a>
                                                <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{$productArr->id}}','{{$home_product_attr[$productArr->id][0]->cover_type}}')">
                                                    <span class="fa fa-shopping-cart"></span>Thêm vào giỏ hàng
                                                </a>
                                                    <span class="fa fa-shopping-cart"></span>Thêm vào giỏ hàng
                                                </a>
                                                <figcaption>
                                                    <h4 class="aa-product-title">
                                                        <a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a>
                                                    </h4>
                                                    <span class="aa-product-price">{{$home_trending_product_attr[$productArr->id][0]->price}} đ</span>
                                                    <span class="aa-product-price">
                                                        <del>{{$home_trending_product_attr[$productArr->id][0]->mrp}} đ</del>
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
                                </div>
                                <!-- / featured product category -->
                                <!-- start discounted product category -->
                                <div class="tab-pane fade" id="discounted">
                                    <ul class="aa-product-catg aa-featured-slider">
                                    <!-- start single product item -->
                                    @if(isset($home_discounted_product[$list->id][0]))
                                    @foreach($home_discounted_product[$list->id] as $productArr)
                                        <li>
                                            <figure>
                                                <a class="aa-product-img" href="{{url('product/'.$productArr->slug)}}">
                                                    <img src="{{asset('storage/media/product/'.$productArr->image)}}" alt="{{$productArr->name}}" width="250px">
                                                </a>
                                                <a class="aa-add-card-btn" href="javascript:void(0)" onclick="home_add_to_cart('{{$productArr->id}}','{{$home_product_attr[$productArr->id][0]->cover_type}}')">
                                                    <span class="fa fa-shopping-cart"></span>Thêm vào giỏ hàng
                                                </a>
                                                    <span class="fa fa-shopping-cart"></span>Thêm vào giỏ hàng
                                                </a>
                                                <figcaption>
                                                    <h4 class="aa-product-title">
                                                        <a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a>
                                                    </h4>
                                                    <span class="aa-product-price">{{$home_discounted_product_attr[$productArr->id][0]->price}} đ</span>
                                                    <span class="aa-product-price">
                                                        <del>{{$home_discounted_product_attr[$productArr->id][0]->mrp}} đ</del>
                                                    </span>
                                                </figcaption>
                                            </figure>
                                        </li>
                                    @endforeach
                                    @else
                                        <li>
                                            <figure>Không có sản phẩm để hiển thị</figure>
                                        </li>
                                    @endif
                                    </ul>
                                </div>
                                <!-- / latest product category -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / popular section -->
    <!-- Support section -->
    <section id="aa-support">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-support-area">
                    <!-- single support -->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="aa-support-single">
                                <span class="fa fa-truck"></span>
                                <h4>Miễn phí giao hàng</h4>
                                <P>Miễn phí giao hàng cho các đơn hàng trong nội thành hoặc giá đơn hàng đạt 200k.</P>
                            </div>
                        </div>
                    <!-- single support -->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="aa-support-single">
                                <span class="fa fa-clock-o"></span>
                                <h4>Hoàn tiền trong 7 ngày</h4>
                                <P>Hoàn tiền trong 7 ngày nếu sản phẩm đạt đủ các điều kiện để trả hàng.</P>
                            </div>
                        </div>
                    <!-- single support -->
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="aa-support-single">
                                <span class="fa fa-phone"></span>
                                <h4>Hỗ trợ 24/7</h4>
                                <P>Liên hệ với chúng tôi nếu có thắc mắc về sản phẩm.</P>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Support section -->
    <!-- Client Brand -->
    <section id="aa-client-brand">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-client-brand-area">
                        <ul class="aa-client-brand-slider">
                        @foreach($home_publisher as $list)
                            <li>
                                <a href="#">
                                    <img src="{{asset('storage/media/publisher/'.$list->image)}}" alt="{{$list->name}}" width="200px" height="150px">
                                </a>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- / Client Brand -->
    <input type="hidden" id="qty" value="1"/>
    <form id="frmAddToCart">
        <input type="hidden" id="cover_id" name="cover_id"/>
        <input type="hidden" id="pqty" name="pqty"/>
        <input type="hidden" id="product_id" name="product_id"/>
    @csrf
    </form>

@endsection
