@extends('admin/home')
@section('page_title','Quản lý nhà xuất bản')
@section('publisher_select','active')
@section('container')

    <h1 class="mb10 fs-3">Quản lý nhà xuất bản</h1>
    <a href="{{url('admin/publisher')}}">
        <button type="button" class="btn btn-success">Trở về</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('publisher.manage_publisher_process')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <label for="publisher" class="control-label mb-1">Tên nhà xuất bản</label>
                                            <input id="publisher" value="{{$name}}" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            @error('name')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
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
                                        <img width="250px" class="mt-3" src="{{asset('storage/media/publisher/'.$image)}}"/>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="image" class="control-label mb-1">Hiển thị trong trang chủ</label>
                                    <input id="is_home" name="is_home" type="checkbox" class="form-control" {{$is_home_selected}}>
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
