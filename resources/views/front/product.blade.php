@extends('front/layout')
@section('page_title',$product[0]->name)
@section('container')

    <!-- product category -->
    <section id="aa-product-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="aa-product-details-area">
                        <div class="aa-product-details-content">
                            <div class="row">
                            <!-- Modal view slider -->
                                <div class="col-md-5 col-sm-5 col-xs-12">
                                    <div class="aa-product-view-slider">
                                        <div id="demo-1" class="simpleLens-gallery-container">
                                            <div class="simpleLens-container">
                                                <div class="simpleLens-big-image-container">
                                                    <a data-lens-image="{{asset('storage/media/product/'.$product[0]->image)}}" class="simpleLens-lens-image">
                                                        <img src="{{asset('storage/media/product/'.$product[0]->image)}}" class="simpleLens-big-image">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="simpleLens-thumbnails-container">
                                                <a data-big-image="{{asset('storage/media/product/'.$product[0]->image)}}" data-lens-image="{{asset('storage/media/product/'.$product[0]->image)}}" class="simpleLens-thumbnail-wrapper" href="#">
                                                    <img src="{{asset('storage/media/product/'.$product[0]->image)}}" width="70px">
                                                </a>
                                                @if(isset($product_images[$product[0]->id][0]))
                                                @foreach($product_images[$product[0]->id] as $list)
                                                <a data-big-image="{{asset('storage/media/product/'.$list->images)}}" data-lens-image="{{asset('storage/media/product/'.$list->images)}}" class="simpleLens-thumbnail-wrapper" href="#">
                                                    <img src="{{asset('storage/media/product/'.$list->images)}}" width="70px">
                                                </a>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal view content -->
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <div class="aa-product-view-content">
                                        <h3>{{$product[0]->name}}</h3>
                                        <div class="aa-price-block">
                                            <span class="aa-product-view-price">{{$product_attr[$product[0]->id][0]->price}} ??&nbsp;&nbsp;</span>
                                            <span class="aa-product-view-price">
                                            <?php
                                            if($product_attr[$product[0]->id][0]->mrp != 0) {
                                            ?>
                                                <del>{{$product_attr[$product[0]->id][0]->mrp}} ??</del>
                                            <?php
                                            }
                                            ?>
                                            </span>
                                            <p class="aa-product-avilability">T??nh tr???ng:
                                                <span>C??n h??ng</span>
                                            </p>
                                            @if($product[0]->endow != '')
                                            <p class="endow">
                                                {{$product[0]->endow}}
                                            </p>
                                            @endif
                                        </div>
                                        <p>
                                            {!!$product[0]->short_desc!!}
                                        </p>
                                        @if($product_attr[$product[0]->id][0]->product_attr_cover_id > 0)
                                        <h4>Lo???i b??a</h4>
                                        <div class="aa-prod-view-size">
                                        @php
                                            $arrCover = [];
                                            foreach($product_attr[$product[0]->id] as $attr) {
                                                $arrCover[] = $attr->cover_type;
                                            }
                                            $arrCover = array_unique($arrCover);
                                        @endphp
                                        @foreach($arrCover as $attr)
                                        @if($attr != '')
                                            <a href="javascript:void(0)" onclick="clickCover('{{$attr}}')" id="cover_{{$attr}}" class="cover_link">{{$attr}}</a>
                                        @endif
                                        @endforeach
                                        </div>
                                        @endif
                                        <div class="aa-prod-quantity">
                                            <h4>S??? l?????ng</h4>
                                            <form action="">
                                                <select id="qty" name="qty">
                                                @for($i = 1; $i < 11; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                                </select>
                                            </form>
                                            <p class="aa-prod-category">Th??? lo???i:
                                                <a href="#">{{$product_category[$product[0]->id][0]->category_name}}</a>
                                            </p>
                                        </div>
                                        <div class="aa-prod-view-bottom">
                                            <a class="aa-add-to-cart-btn" href="javascript:void(0)" onclick="add_to_cart('{{$product[0]->id}}','{{$product_attr[$product[0]->id][0]->product_attr_cover_id}}')">Th??m v??o gi??? h??ng</a>
                                        </div>
                                        <div id="add_to_cart_msg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="aa-product-details-bottom">
                            <ul class="nav nav-tabs" id="myTab2">
                                <li><a href="#description" data-toggle="tab">M?? t???</a></li>
                                <li><a href="#printing_info" data-toggle="tab">Th??ng tin in ???n</a></li>
                                <li><a href="#warranty" data-toggle="tab">?????m b???o</a></li>
                                <li><a href="#review" data-toggle="tab">Nh???n x??t</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="description">
                                    {!!$product[0]->desc!!}
                                </div>
                                <div class="tab-pane fade" id="printing_info">
                                    {!!$product[0]->printing_info!!}
                                </div>
                                <div class="tab-pane fade" id="warranty">
                                    {!!$product[0]->warranty!!}
                                </div>
                                <div class="tab-pane fade " id="review">
                                    <div class="aa-product-review-area">
                                    @if(isset($product_reviews[0]))
                                        <h4>
                                        @php
                                            echo count($product_reviews);
                                        @endphp
                                            ????nh gi?? cho {{$product[0]->name}}
                                        </h4>
                                        <ul class="aa-review-nav">
                                        @foreach($product_reviews as $list)
                                            <li>
                                                <div class="media">
                                                    <div class="media-body">
                                                        <h4 class="media-heading">
                                                            <strong>{{$list->name}}</strong> - <span>{{getCustomDate($list->added_on)}}</span>
                                                        </h4>
                                                        <div class="aa-product-rating">
                                                            <span class="rating_txt">{{$list->rating}}</span>
                                                        </div>
                                                        <p>{{$list->review}}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                        </ul>
                                    @else
                                        <h2>S???n ph???m ch??a c?? b??nh lu???n</h2>
                                    @endif
                                        <form id="frmProductReview" class="aa-review-form">
                                            <h4>????nh gi?? s???n ph???m</h4>
                                            <div class="aa-your-rating">
                                                <p>????nh gi?? c???a b???n</p>
                                                <select class="form-control" name="rating" required>
                                                    <option value="">Ch???n ????nh gi??</option>
                                                    <option>Kh??ng th??ch</option>
                                                    <option>B??nh th?????ng</option>
                                                    <option>Th??ch</option>
                                                    <option>R???t th??ch</option>
                                                    <option>Tuy???t v???i</option>
                                                </select>
                                            </div>
                                            <!-- review form -->
                                            <div class="form-group">
                                                <label for="message">B??nh lu???n c???a b???n</label>
                                                <textarea class="form-control" rows="3"  name="review" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-default aa-review-submit">????nh gi??</button>
                                            <input type="hidden" name="product_id" value="{{$product[0]->id}}"/>
                                            @csrf
                                        </form>
                                        <div class="review_msg"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Related product -->
                            <div class="aa-product-related-item">
                                <h3>S???n ph???m t????ng t???</h3>
                                <ul class="aa-product-catg aa-related-item-slider">
                                @if(isset($related_product[0]))
                                @foreach($related_product as $productArr)
                                    <li>
                                        <figure>
                                            <a class="aa-product-img" href="{{url('product/'.$productArr->slug)}}">
                                                <img src="{{asset('storage/media/product/'.$productArr->image)}}" alt="{{$productArr->name}}" width="250px">
                                            </a>
                                            <a class="aa-add-card-btn" href="{{url('product/'.$productArr->slug)}}">
                                                <span class="fa fa-shopping-cart"></span>Th??m v??o gi??? h??ng
                                            </a>
                                            <figcaption>
                                                <h4 class="aa-product-title">
                                                    <a href="{{url('product/'.$productArr->slug)}}">{{$productArr->name}}</a>
                                                </h4>
                                                <span class="aa-product-price">{{$related_product_attr[$productArr->id][0]->price}} ??</span>
                                                <span class="aa-product-price">
                                                    <del>{{$related_product_attr[$productArr->id][0]->mrp}} ??</del>
                                                </span>
                                            </figcaption>
                                        </figure>
                                    </li>
                                @endforeach
                                @else
                                    <li>
                                        <figure>Kh??ng c?? s???n ph???m t????ng t???<figure>
                                    <li>
                                @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <form id="frmAddToCart">
        <input type="hidden" id="cover_id" name="cover_id"/>
        <input type="hidden" id="pqty" name="pqty"/>
        <input type="hidden" id="product_id" name="product_id"/>
        @csrf
    </form>

@endsection
