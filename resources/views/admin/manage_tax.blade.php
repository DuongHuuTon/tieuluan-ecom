@extends('admin/home')
@section('page_title','Quản lý thuế')
@section('tax_select','active')
@section('container')

    <h1 class="mb10 fs-3">Quản lý thuế</h1>
    <a href="{{url('admin/tax')}}">
        <button type="button" class="btn btn-success">Trở về</button>
    </a>
    <div class="row m-t-30">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('tax.manage_tax_process')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="size" class="control-label mb-1">Tên Thuế</label>
                                    <input id="tax_desc" value="{{$tax_desc}}" name="tax_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                </div>
                                <div class="form-group">
                                    <label for="size" class="control-label mb-1">Giá trị Thuế</label>
                                    <input id="tax_value" value="{{$tax_value}}" name="tax_value" type="number" class="form-control" aria-required="true" aria-invalid="false" required>
                                    @error('tax_value')
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
