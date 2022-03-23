@extends('admin/home')
@section('page_title','Quản lý mã giảm giá')
@section('coupon_select','active')
@section('container')

    <h1 class="mb10 fs-3">Quản lý mã giảm giá</h1>
    <a href="{{url('admin/coupon')}}">
        <button type="button" class="btn btn-success">Trở về</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('coupon.manage_coupon_process')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="title" class="control-label mb-1">Tên mã</label>
                                            <input id="title" value="{{$title}}" name="title" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="code" class="control-label mb-1">Mã giảm giá</label>
                                            <input id="code" value="{{$code}}" name="code" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                            @error('code')
                                            <div class="alert alert-danger" role="alert">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="value" class="control-label mb-1">Giá trị</label>
                                            <input id="value" value="{{$value}}" name="value" type="number" class="form-control" aria-required="true" aria-invalid="false" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="value" class="control-label mb-1">Kiểu giảm giá</label>
                                            <select id="type" name="type" class="form-control" required>
                                                @if($type == 'Value')
                                                    <option value="Value" selected>Giá tiền</option>
                                                    <option value="Percent">Phần trăm</option>
                                                @elseif($type == 'Percent')
                                                    <option value="Value">Giá tiền</option>
                                                    <option value="Percent" selected>Phần trăm</option>
                                                @else
                                                    <option value="Value">Giá tiền</option>
                                                    <option value="Percent">Phần trăm</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="title" class="control-label mb-1">Số tiền đạt tối thiểu</label>
                                            <input id="min_order_amt" value="{{$min_order_amt}}" name="min_order_amt" type="number" class="form-control" aria-required="true" aria-invalid="false" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="code" class="control-label mb-1">Dùng 1 lần</label>
                                            <select id="is_one_time" name="is_one_time" class="form-control" required>
                                                @if($is_one_time == '1')
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
