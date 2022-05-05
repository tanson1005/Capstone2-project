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
                    <li>Liên hệ</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!--breadcrumb area end-->


<!--contact area css satrt-->
<div class="contact_area ptb-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <div class="contact_map_wrapper">
                    <div class="contact_map mb-40">
                        <!-- Contact Map Start -->
                        <div id="contact-map"></div>
                        <!-- Contact Map End -->
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-5">
                <div class="contact_info_wrapper">
                    <div class="contact_title">
                        <h4>Thông tin & địa chỉ</h4>
                    </div>
                    <div class="contact_info mb-15">
                        <div class="contact_info_icone">
                            <a href="#"><i class="icofont icofont-location-pin"></i></a>
                        </div>
                        <div class="contact_info_text">
                            <p><span>Địa chỉ:</span> 123 - Nguyễn Lương Bằng<br> Liên Chiểu, TP. Đà Nẵng</p>
                        </div>
                    </div>
                    <div class="contact_info mb-15">
                        <div class="contact_info_icone">
                            <a href="#"><i class="icofont icofont-email"></i></a>
                        </div>
                        <div class="contact_info_text">
                            <p><span>Email: </span> Support@plazathemes.com </p>
                        </div>
                    </div>
                    <div class="contact_info mb-15">
                        <div class="contact_info_icone">
                            <a href="#"><i class="icofont icofont-phone"></i></a>
                        </div>
                        <div class="contact_info_text">
                            <p><span>SĐT:</span> (84) 123 456 789 </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--contact area css end-->
<div class="organic_food_wrapper">
    <!--Brand logo start-->
    <div class="brand_logo">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="brand_list_carousel owl-carousel">
                        <div class="single_brand_logo">
                            <a href="#">
                                <img src="../FrontEnd/assets/img/brand/1.png" alt="brand logo">
                            </a>
                        </div>
                        <div class="single_brand_logo">
                            <a href="#">
                                <img src="../FrontEnd/assets/img/brand/2.png" alt="brand logo">
                            </a>
                        </div>
                        <div class="single_brand_logo">
                            <a href="#">
                                <img src="../FrontEnd/assets/img/brand/3.png" alt="brand logo">
                            </a>
                        </div>
                        <div class="single_brand_logo">
                            <a href="#">
                                <img src="../FrontEnd/assets/img/brand/4.png" alt="brand logo">
                            </a>
                        </div>
                        <div class="single_brand_logo">
                            <a href="#">
                                <img src="../FrontEnd/assets/img/brand/5.png" alt="brand logo">
                            </a>
                        </div>
                        <div class="single_brand_logo">
                            <a href="#">
                                <img src="../FrontEnd/assets/img/brand/1.png" alt="brand logo">
                            </a>
                        </div>
                        <div class="single_brand_logo">
                            <a href="#">
                                <img src="../FrontEnd/assets/img/brand/2.png" alt="brand logo">
                            </a>
                        </div>
                        <div class="single_brand_logo">
                            <a href="#">
                                <img src="../FrontEnd/assets/img/brand/3.png" alt="brand logo">
                            </a>
                        </div>
                        <div class="single_brand_logo">
                            <a href="#">
                                <img src="../FrontEnd/assets/img/brand/4.png" alt="brand logo">
                            </a>
                        </div>
                        <div class="single_brand_logo">
                            <a href="#">
                                <img src="../FrontEnd/assets/img/brand/5.png" alt="brand logo">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Brand logo end-->
</div>

<!--Map js -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlZPf84AAVt8_FFN7rwQY5nPgB02SlTKs"></script>
<script src="{{asset('FrontEnd/assets/js/map.js')}}"></script>
@endsection
