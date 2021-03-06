@extends('layouts.panel')
@section('styles')
<link href="{{ asset('css/admin/detailProduct.css') }}" rel="stylesheet">
@endsection
@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4  bg-primary">
    <div class="card-header py-3">
        <p class="m-0 font-weight-bold text-primary">
            <a href="{{route('products.index')}}" class="border border-primary rounded text-decoration-none">
                Danh sách sản phẩm</a>
            <span> <i class="fas fa-chevron-right"></i>Thông tin sản phẩm</span>
        </p>
    </div>
    <div class="text-right mr-2">
        <a href="{{route('products.index')}}" class="badge badge-warning">Trở lại</a>
    </div>
    <div class='container-fluid'>
        <div class="card mx-auto col-md-3 col-12 mt-5 pt-4">
            <div class="d-flex sale ">
            </div> <img class='mx-auto img-thumbnail' src="{{url('img/products', $data->product_image) }}" width="200px"
                height="300px" />
            <div class="card-body text-center mx-auto">
                <div class="card-title">
                    <span class="des">Mô tả</span>
                </div>
                <p class="card-text">{{ $data->product_name }}</p>
                <p class="card-text">{{ $data->product_symbol }}</p>
                <p class="card-text">{{ $data->product_description }}</p>
                <p class="card-text">Giá: {{number_format($data->product_price)}}VND</p>
                <p class="card-text">{{ $productTypes }}</p>
            </div>
        </div>
    </div>
    @endsection
