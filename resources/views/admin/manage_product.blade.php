@extends('admin/home')
@section('page_title','Quản lý sản phẩm')
@section('product_select','active')
@section('container')

    @if($id>0)
        @php
            $image_required = "";
        @endphp
    @else
        @php
            $image_required = "required";
        @endphp
    @endif

    <h1 class="mb10 fs-3">Quản lý sản phẩm</h1>
    @if(session()->has('isbn_error'))
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        {{session('isbn_error')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif
    @error('attr_image.*')
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @enderror
    @error('images.*')
    <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
        {{$message}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @enderror
    <a href="{{url('admin/product')}}">
        <button type="button" class="btn btn-success">Trở về</button>
    </a>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <div class="row m-t-30">
        <div class="col-md-12">
            <form action="{{route('product.manage_product_process')}}" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="control-label mb-1">Tên sản phẩm</label>
                                    <input id="name" value="{{$name}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    @error('name')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="slug" class="control-label mb-1">Đường dẫn tĩnh</label>
                                    <input id="slug" value="{{$slug}}" name="slug" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    @error('slug')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keywords" class="control-label mb-1">Từ khóa tìm kiếm</label>
                                    <textarea id="keywords" name="keywords" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$keywords}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="control-label mb-1">Hình ảnh</label>
                                    <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}>
                                    @error('image')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    @if($image!='')
                                    <a href="{{asset('storage/media/product/'.$image)}}" target="_blank">
                                        <img width="250px" class="mt-3" src="{{asset('storage/media/product/'.$image)}}"/>
                                    </a>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="category_id" class="control-label mb-1">Danh mục</label>
                                            <select id="category_id" name="category_id" class="form-control" required>
                                                <option value="">Chọn danh mục</option>
                                                    @foreach($category as $list)
                                                        @if($category_id == $list->id)
                                                            <option selected value="{{$list->id}}">
                                                        @else
                                                            <option value="{{$list->id}}">
                                                        @endif
                                                                {{$list->category_name}}
                                                            </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="publisher_id" class="control-label mb-1">Nhà xuất bản</label>
                                            <select id="publisher" name="publisher" class="form-control" required>
                                                <option value="">Chọn nhà xuất bản</option>
                                                    @foreach($publishers as $list)
                                                        @if($publisher == $list->id)
                                                            <option selected value="{{$list->id}}">
                                                        @else
                                                            <option value="{{$list->id}}">
                                                        @endif
                                                                {{$list->name}}
                                                            </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="short_desc" class="control-label mb-1">Mô tả ngắn</label>
                                    <textarea id="short_desc" name="short_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$short_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="desc" class="control-label mb-1">Mô tả sản phẩm</label>
                                    <textarea id="desc" name="desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="printing_info" class="control-label mb-1">Thông tin in ấn</label>
                                    <textarea id="printing_info" name="printing_info" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$printing_info}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="warranty" class="control-label mb-1">Đảm bảo</label>
                                    <textarea id="warranty" name="warranty" type="text" class="form-control" aria-required="true" aria-invalid="false" required>{{$warranty}}</textarea>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <label for="model" class="control-label mb-1">Ưu đãi</label>
                                            <input id="endow" value="{{$endow}}" name="endow" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="tax_id" class="control-label mb-1">Thuế</label>
                                            <select id="tax_id" name="tax_id" class="form-control" required>
                                                <option value="">Chọn loại thuế</option>
                                                    @foreach($taxes as $list)
                                                        @if($tax_id == $list->id)
                                                            <option selected value="{{$list->id}}">
                                                        @else
                                                            <option value="{{$list->id}}">
                                                        @endif
                                                                {{$list->tax_desc}}
                                                            </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="model" class="control-label mb-1">Khuyển mãi</label>
                                            <select id="is_promo" name="is_promo" class="form-control" required>
                                                @if($is_promo == '1')
                                                <option value="1" selected>Có</option>
                                                <option value="0">Không</option>
                                                @else
                                                <option value="1">Có</option>
                                                <option value="0" selected>Không</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="model" class="control-label mb-1">Nổi bật</label>
                                            <select id="is_featured" name="is_featured" class="form-control" required>
                                                @if($is_featured == '1')
                                                <option value="1" selected>Có</option>
                                                <option value="0">Không</option>
                                                @else
                                                <option value="1">Có</option>
                                                <option value="0" selected>Không</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="model" class="control-label mb-1">Xu hướng</label>
                                            <select id="is_trending" name="is_trending" class="form-control" required>
                                                @if($is_trending == '1')
                                                <option value="1" selected>Có</option>
                                                <option value="0">Không</option>
                                                @else
                                                <option value="1">Có</option>
                                                <option value="0" selected>Không</option>
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="model" class="control-label mb-1">Chiết khấu</label>
                                            <select id="is_discounted" name="is_discounted" class="form-control" required>
                                                @if($is_discounted == '1')
                                                <option value="1" selected>Có</option>
                                                <option value="0">Không</option>
                                                @else
                                                <option value="1">Có</option>
                                                <option value="0" selected>Không</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 class="mb10 ml15">Ảnh sản phẩm</h2>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row" id="product_images_box">
                                        @php
                                            $loop_count_num = 1;
                                        @endphp
                                        @foreach($productImagesArr as $key=>$val)
                                        @php
                                            $loop_count_prev = $loop_count_num;
                                            $pIArr = (array)$val;
                                        @endphp
                                        <input id="piid" type="hidden" name="piid[]" value="{{$pIArr['id']}}">
                                        <div class="col-md-4 product_images_{{$loop_count_num++}}"  >
                                            <label for="images" class="control-label mb-1">Hình ảnh</label>
                                            <input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                                                @if($pIArr['images']!='')
                                                <a href="{{asset('storage/media/product/'.$pIArr['images'])}}" target="_blank">
                                                    <img width="250px" class="mt-3" src="{{asset('storage/media/product/'.$pIArr['images'])}}"/>
                                                </a>
                                                @endif
                                        </div>
                                        <div class="col-md-2">
                                            <label for="images" class="control-label mb-1">
                                                &nbsp;&nbsp;&nbsp;
                                            </label>
                                            @if($loop_count_num == 2)
                                            <button type="button" class="btn btn-success btn-lg" onclick="add_image_more()">
                                                <i class="fa fa-plus"></i>&nbsp; Thêm
                                            </button>
                                            @else
                                            <a href="{{url('admin/product/product_images_delete/')}}/{{$pIArr['id']}}/{{$id}}">
                                                <button type="button" class="btn btn-danger btn-lg">
                                                    <i class="fa fa-minus"></i>&nbsp; Hủy
                                                </button>
                                            </a>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 class="mb10 ml15">Thuộc tính sản phẩm</h2>
                    <div class="col-lg-12" id="product_attr_box">
                    @php
                        $loop_count_num = 1;
                    @endphp
                    @foreach($productAttrArr as $key=>$val)
                        @php
                            $loop_count_prev = $loop_count_num;
                            $pAArr = (array)$val;
                        @endphp
                        <input id="paid" type="hidden" name="paid[]" value="{{$pAArr['id']}}">
                        <div class="card" id="product_attr_{{$loop_count_num++}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="isbn" class="control-label mb-1">Mã sản phẩm</label>
                                            <input id="isbn" name="isbn[]" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['isbn']}}" required>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="mrp" class="control-label mb-1">Giá bán thường</label>
                                            <input id="mrp" name="mrp[]" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['mrp']}}">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="price" class="control-label mb-1">Giá khuyến mãi</label>
                                            <input id="price" name="price[]" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['price']}}" required>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="cover_id" class="control-label mb-1">Loại bìa</label>
                                            <select id="cover_id" name="cover_id[]" class="form-control">
                                                <option value="">Chọn loại bìa</option>
                                                @foreach($covers as $list)
                                                    @if($pAArr['product_attr_cover_id'] == $list->id)
                                                        <option value="{{$list->id}}" selected>{{$list->cover_type}}</option>
                                                    @else
                                                        <option value="{{$list->id}}">{{$list->cover_type}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="qty" class="control-label mb-1">Số lượng</label>
                                            <input id="qty" name="qty[]" type="number" class="form-control" aria-required="true" aria-invalid="false" value="{{$pAArr['qty']}}" required>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <label for="attr_image" class="control-label mb-1">Ảnh sản phẩm</label>
                                            <input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" >
                                            @if($pAArr['attr_image'] != '')
                                                <img width="250px" class="mt-3" src="{{asset('storage/media/product/'.$pAArr['attr_image'])}}"/>
                                            @endif
                                        </div>
                                        <div class="col-md-2">
                                            <label for="attr_image" class="control-label mb-1">
                                                &nbsp;&nbsp;&nbsp;
                                            </label>
                                            @if($loop_count_num == 2)
                                            <button type="button" class="btn btn-success btn-lg" onclick="add_more()">
                                                <i class="fa fa-plus"></i>&nbsp; Thêm
                                            </button>
                                            @else
                                            <a href="{{url('admin/product/product_attr_delete/')}}/{{$pAArr['id']}}/{{$id}}">
                                                <button type="button" class="btn btn-danger btn-lg">
                                                    <i class="fa fa-minus"></i>&nbsp; Hủy
                                                </button>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">Gửi đi</button>
                </div>
                <input type="hidden" name="id" value="{{$id}}"/>
            </form>
        </div>
    </div>

    <script>
        var loop_count = 1;
        function add_more() {
            loop_count++;
            var html='<input id="paid" type="hidden" name="paid[]" ><div class="card" id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';
                html+='<div class="col-md-2"><label for="isbn" class="control-label mb-1">Mã sản phẩm</label><input id="isbn" name="isbn[]" type="text" class="form-control" aria-required="true" aria-invalid="false" required></div>';
                html+='<div class="col-md-2"><label for="mrp" class="control-label mb-1">Giá bán thường</label><input id="mrp" name="mrp[]" type="number" class="form-control" aria-required="true" aria-invalid="false"></div>';
                html+='<div class="col-md-2"><label for="price" class="control-label mb-1">Giá khuyến mãi</label><input id="price" name="price[]" type="number" class="form-control" aria-required="true" aria-invalid="false" required></div>';
            var cover_id_html = jQuery('#cover_id').html();
                cover_id_html = cover_id_html.replace("selected", "");
                html+='<div class="col-md-3"><label for="cover_id" class="control-label mb-1">Loại bìa</label><select id="cover_id" name="cover_id[]" class="form-control">'+cover_id_html+'</select></div>';
                html+='<div class="col-md-2"><label for="qty" class="control-label mb-1">Số lượng</label><input id="qty" name="qty[]" type="number" class="form-control" aria-required="true" aria-invalid="false" required></div>';
                html+='<div class="col-md-4 mt-3"><label for="attr_image" class="control-label mb-1">Ảnh sản phẩm</label><input id="attr_image" name="attr_image[]" type="file" class="form-control" aria-required="true" aria-invalid="false" ></div>';
                html+='<div class="col-md-2 mt-3"><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_more("'+loop_count+'")><i class="fa fa-minus"></i>&nbsp; Hủy</button></div>';
                html+='</div></div></div></div>';
            jQuery('#product_attr_box').append(html)
        }
        function remove_more(loop_count) {
            jQuery('#product_attr_'+loop_count).remove();
        }
        var loop_image_count = 1;
        function add_image_more() {
            loop_image_count++;
            var html='<input id="piid" type="hidden" name="piid[]" value=""><div class="col-md-4 mt-3 product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1">Ảnh sản phẩm</label><input id="images" name="images[]" type="file" class="form-control" aria-required="true" aria-invalid="false" required></div>';
                html+='<div class="col-md-2 mt-3 product_images_'+loop_image_count+'""><label for="attr_image" class="control-label mb-1"> &nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_image_more("'+loop_image_count+'")><i class="fa fa-minus"></i>&nbsp; Hủy</button></div>';
            jQuery('#product_images_box').append(html)
        }
        function remove_image_more(loop_image_count) {
            jQuery('.product_images_'+loop_image_count).remove();
        }
        CKEDITOR.replace('short_desc');
        CKEDITOR.replace('desc');
        CKEDITOR.replace('printing_info');
    </script>

@endsection
