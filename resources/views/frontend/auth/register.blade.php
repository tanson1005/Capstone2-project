@extends('layouts.frontend')
@section('content')
    <!-- Add your site or application content here -->

    <!--breadcrumb area start-->
    <div class="breadcrumb_container container">
            <div class="row">
                <div class="col-12">
                    <nav>
                        <ul>
                            <li>
                                <a href="index.html">Trang chủ ></a>
                            </li>
                            <li>Đăng ký thành viên</li>
                        </ul>
                    </nav>
                </div>
            </div>
    </div>
    <!--breadcrumb area end-->

    <!--login section start-->
    <div class="page_login_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="register_page_form">
                        @foreach($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                        <form method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input_text">
                                        <label for="name">Tên khách hàng <span>*</span></label>
                                        <input id="name" name="name" type="text">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input_text">
                                        <label for="phone">Số điện thoại <span>*</span></label>
                                        <input id="phone" name="phone" type="text">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input_text">
                                        <label for="address">Địa chỉ <span>*</span></label>
                                        <input id="address" name="address" type="text">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input_text">
                                        <label for="email">Email <span>*</span></label>
                                        <input id="email" name="email" type="text">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input_text">
                                        <label for="password">Mật khẩu<span>*</span></label>
                                        <input id="password" name="password" type="password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input_text">
                                        <label for="password_confirmation">Nhập lại mật khẩu<span>*</span></label>
                                        <input id="password_confirmation" name="password_confirmation" type="password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input_text">
                                        <label for="remember_me">Tồi đồng ý với các điều kiện và yêu cầu</label>
                                        <input id="remember_me" type="checkbox">
                                    </div>
                                </div>
                                @csrf
                                <div class="col-12">
                                    <div class="login_submit">
                                        <input value="Đăng ký" type="submit">
                                    </div>
                                    <p><a class="text-primary" href="{{route('login')}}">Nhấp vào đây</a> để đăng nhập</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--login section end-->

@endsection
