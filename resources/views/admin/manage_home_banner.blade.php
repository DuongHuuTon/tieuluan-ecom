@extends('admin/home')
@section('page_title','Quản lý ảnh trang chủ')
@section('home_banner_select','active')
@section('container')

    <h1 class="mb10 fs-3">Quản lý ảnh trang chủ</h1>
    <a href="{{url('admin/home_banner')}}">
        <button type="button" class="btn btn-success">Trở về</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('home_banner.manage_home_banner_process')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="category_name" class="control-label mb-1">Tên nút</label>
                                            <input id="btn_txt" value="{{$btn_txt}}" name="btn_txt" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="category_slug" class="control-label mb-1">Đường dẫn</label>
                                            <input id="btn_link" value="{{$btn_link}}" name="btn_link" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="control-label mb-1">Hình ảnh</label>
                                    <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false">
                                    @error('image')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    @if($image!='')
                                        <a href="{{asset('storage/media/banner/'.$image)}}" target="_blank">
                                            <img width="250px" class="mt-3" src="{{asset('storage/media/banner/'.$image)}}"/>
                                        </a>
                                    @endif
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">Gửi đi</button>
                                </div>
                                <input type="hidden" name="id" value="{{$id}}"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
