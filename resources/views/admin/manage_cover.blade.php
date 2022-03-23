@extends('admin/home')
@section('page_title','Quản lý bìa sách')
@section('cover_select','active')
@section('container')

    <h1 class="mb10 fs-3">Quản lý bìa sách</h1>
    <a href="{{url('admin/cover')}}">
        <button type="button" class="btn btn-success">Trở về</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('cover.manage_cover_process')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="cover_type" class="control-label mb-1">Loại bìa</label>
                                    <input id="cover_type" value="{{$cover_type}}" name="cover_type" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    @error('cover_type')
                                    <div class="alert alert-danger" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
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
