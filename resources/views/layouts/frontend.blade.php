<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('FrontEndassets/img/favicon.png')}}">

    <!-- all css here -->
    <link rel="stylesheet" href="{{asset('FrontEnd/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/assets/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/assets/css/chosen.min.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/assets/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/assets/css/material-design-iconic-font.min.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/assets/css/meanmenu.min.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/assets/css/bundle.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('FrontEnd/assets/css/responsive.css')}}">
    <script src="{{asset('FrontEnd/assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>

    <!-- Css Alert -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />

    <!-- Yield styles -->
    @yield('styles')

</head>

<body>
    <!-- Add your site or application content here -->

    <!--organicfood wrapper start-->
    <div class="organic_food_wrapper">

        <header class="header sticky-header">
            <div class="organic_food_wrapper">
                <!--Header start-->
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="header_wrapper_inner">
                                <div class="logo col-xs-12">
                                    <a href="{{route('frontend.index')}}">
                                        <img src="{{ asset('FrontEnd/assets/img/logo/logo.png') }}" alt="">
                                    </a>
                                </div>
                                <div class="main_menu_inner">
                                    <div class="menu">
                                        <nav>
                                            <ul>
                                                <li class="active"><a href="{{route('frontend.index')}}">Trang ch??? </a>

                                                </li>
                                                <li><a href="{{route('about.us')}}">Ch??ng t??i </a> </li>
                                                <li><a href="{{route('shop.index')}}">C???a h??ng</a> </li>
                                                <li><a href="blog.html">Blog </a>
                                                </li>
                                                <li class="mega_parent"><a href="#">Danh m???c <i class="fa fa-angle-down"></i></a>
                                                    <ul class="mega_menu">
                                                        <li class="mega_item">
                                                            <ul>
                                                                <li><a href="{{route('shop.index')}}">S???n ph???m</a></li>
                                                                <li><a href="{{route('show.cart')}}">Gi??? h??ng</a></li>
                                                                <li><a href="{{route('checkout.cart')}}">Thanh to??n</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="mega_item">
                                                            <ul>
                                                                <li><a href="{{route('login')}}">????ng nh???p</a></li>
                                                                <li><a href="{{route('register')}}">????ng k??</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="mega_item">
                                                            <ul>

                                                                <li><a href="{{route('contact.us')}}">Li??n h??? </a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                @if(Auth::user() == null)
                                                <li class="mega_parent"><a class="text-primary" href="{{route('login')}}">????ng Nh???p</a>
                                                </li>
                                                @endif
                                            </ul>
                                        </nav>
                                    </div>

                                    <div class="mobile-menu d-lg-none">
                                        <nav>
                                            <ul>
                                                <li class="active"><a href="{{route('frontend.index')}}">Trang ch??? </a>

                                                </li>
                                                <li><a href="about.html">Ch??ng t??i </a> </li>
                                                <li><a href="{{route('shop.index')}}">C???a h??ng</a> </li>
                                                <li><a href="blog.html">Blog </a>
                                                </li>
                                                <li class="mega_parent"><a href="#">Danh m???c <i class="fa fa-angle-down"></i></a>
                                                    <ul class="mega_menu">
                                                        <li class="mega_item">
                                                            <a class="mega_title" href="#">1</a>
                                                            <ul>
                                                                <li><a href="wishlist.html">Danh m???c ??u th??ch</a></li>
                                                                <li><a href="{{route('shop.index')}}">S???n ph???m</a></li>
                                                                <li><a href="{{route('show.cart')}}">Gi??? h??ng</a></li>
                                                                <li><a href="{{route('checkout.cart')}}">Thanh to??n</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="mega_item">
                                                            <a class="mega_title" href="#"> 2</a>
                                                            <ul>
                                                                <li><a href="my-account.html">T??i kho???n</a></li>
                                                                <li><a href="login.html">????ng nh???p</a></li>
                                                                <li><a href="register.html">????ng k??</a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="mega_item">
                                                            <a class="mega_title" href="#"> 3</a>
                                                            <ul>

                                                                <li><a href="contact.html">Li??n h??? </a></li>
                                                                <li><a href="404.html">B??o l???i</a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="mega_parent"><a class="text-primary" href="{{route('login')}}">????ng k??</a>

                                                </li>

                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                                <div class="header_right_info d-flex">
                                    <div class="search_box">
                                        <div class="search_inner">
                                            <form action="{{route('search.index')}}">
                                                <input type="text" name="search" placeholder="T??m s???n ph???m">
                                                <button type="submit"><i class="ion-ios-search"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="mini__cart">
                                        <div class="mini_cart_inner">
                                            <div id="cart-icon">

                                                <div class="cart_icon ">
                                                    <a href="#">
                                                        @php $totlalQty = 0 @endphp
                                                        @if(session()->get('cart') != null)
                                                        @foreach ( session('cart') as $id => $cart )
                                                        @php
                                                        $totlalQty +=$cart['quantity'];
                                                        @endphp
                                                        @endforeach
                                                        @endif
                                                        <span class="cart_icon_inner">
                                                            <i class="ion-android-cart"></i>
                                                            <span class="cart_count">{{$totlalQty}}</span>
                                                        </span>

                                                    </a>
                                                </div>
                                            </div>
                                            <!--Mini Cart Box-->
                                            <div class="mini_cart_box cart_box_one">
                                                <div id="change-item-cart">
                                                    @if (session('cart'))
                                                    @php $total = 0 @endphp
                                                    @foreach (session('cart') as $id => $cart )
                                                    <div class="mini_cart_item">
                                                        <div class="mini_cart_img">
                                                            <a href="#">
                                                                <img src="{{url('img/products',$cart['image'])}} " width="50px" height="50px">
                                                                <span class="cart_count">{{$cart['quantity']}} </span>
                                                            </a>
                                                        </div>
                                                        <div class="cart_info">
                                                            <h5><a href="product-details.html">{{$cart['name']}} </a>
                                                            </h5>
                                                            <span class="cart_price">{{number_format($cart['price'])}}Vnd
                                                            </span>
                                                        </div>
                                                        <div class="cart_remove">
                                                            <a href="#"><i data-id="{{$id}}" class="zmdi zmdi-delete"></i></a>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @endif
                                                    <div class="price_content">
                                                        @php $total = 0 @endphp
                                                        @foreach ((array) session('cart') as $id => $cart )
                                                        @php
                                                        $total += $cart['price'] * $cart['quantity'];
                                                        @endphp
                                                        @endforeach

                                                        <div class="cart-total-price">
                                                            <span class="label">T???ng ti???n </span>
                                                            <span class="value"> {{number_format($total)}}Vnd</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="min_cart_view">
                                                    <a href="{{route('show.cart')}}">Xem gi??? h??ng</a>
                                                </div>

                                                <div class="min_cart_checkout">
                                                    <a href="{{route('checkout.cart')}}">Thanh To??n</a>
                                                </div>
                                            </div>

                                            <!--Mini Cart Box End -->
                                        </div>
                                    </div>
                                    @if(Auth::user() != null)
                                    <div class="header_account">
                                        <div class="account_inner">
                                            <a href="#"><i class="ion-gear-b"></i></a>
                                        </div>
                                        <div class="content-setting-dropdown">
                                            <div class="user_info_top">
                                                <ul>
                                                    <li><a href="{{route('my-account')}}">T??i kho???n c???a t??i</a></li>
                                                    <li><a href="{{route('checkout.cart')}}">Thanh to??n</a></li>
                                                    <li><a href="{{route('logout')}}">????ng xu???t</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </header>
        <!--Header end-->

        <!--Main start-->


        @yield('content')

        <!--Main end-->


        <!-- footer start -->
        <footer class="footer pt-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-xs-12">
                        <!--Single Footer-->
                        <div class="single_footer widget">
                            <div class="single_footer_widget_inner">
                                <div class="footer_logo">
                                    <a href="#"><img src="{{ asset('FrontEnd/assets/img/logo/logo_footer.png') }}" alt=""></a>
                                </div>
                                <div class="footer_content">
                                    <p>?????a ch???: 123 T??n ?????c Th???ng, H??a Minh, Tp. ???? N???ng </p>
                                    <p>S??T: +(84) 800 456 789</p>
                                    <p>Email: Contact@gmail.com</p>
                                </div>
                                <div class="footer_social">
                                    <h4>Li??n h??? qua:</h4>
                                    <div class="footer_social_icon">
                                        <a href="https://facebook.com"><i class="fa fa-facebook"></i></a>
                                        <a href="https://twitter.com"><i class="fa fa-twitter"></i></a>
                                        <a href="https://gmail.com"><i class="fa fa-google-plus"></i></a>
                                        <a href="https://youtube.com"><i class="fa fa-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Single Footer-->
                    </div>
                    <div class="col-lg-6 col-md-12 col-xs-12">
                        <div class="footer_menu_list d-flex justify-content-between">
                            <!--Single Footer-->
                            <div class="single_footer widget">
                                <div class="single_footer_widget_inner">
                                    <div class="footer_title">
                                        <h2>S???n Ph???m</h2>
                                    </div>
                                    <div class="footer_menu">
                                        <ul>

                                            <li><a href="{{route('shop.index')}}"> S???n ph???m m???i</a></li>
                                            <li><a href="{{route('shop.index')}}"> S???n ph???m b??n ch???y</a></li>
                                            <li><a href=" "> Li??n h??? ch??ng t??i</a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--Single footer end-->
                            <!--Single footer start-->
                            <div class="single_footer widget">
                                <div class="single_footer_widget_inner">
                                    <div class="footer_title">
                                        <h2>????ng nh???p</h2>
                                    </div>
                                    <div class="footer_menu">
                                        <ul>
                                            <li><a href="#"> ????ng nh???p</a></li>
                                            <li><a href=" "> ????ng k??</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--Single Footer end-->
                            <!--Single footer start-->
                            <div class="single_footer widget">
                                <div class="single_footer_widget_inner">
                                    <div class="footer_title">
                                        <h2> T??i kho???n c???a b???n </h2>
                                    </div>
                                    <div class="footer_menu">
                                        <ul>
                                            <li><a href="#">Th??ng tin c?? nh??n</a></li>
                                            <li><a href="#"> ????n h??ng</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--Single Footer end-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <div class="copyright_text">
                                <p>Copyright 2021 <a href="#">Organicfood</a>. All Rights Reserved</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12">
                            <div class="footer_mastercard text-right">
                                <a href="#"><img src="{{ asset('FrontEnd/assets/img/brand/payment.png') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </footer>

        <!-- footer end -->



    </div>



    <!-- all js here -->
    <script src="{{asset('FrontEnd/assets/js/vendor/jquery-1.12.0.min.js')}}"></script>
    <script src="{{asset('FrontEnd/assets/js/popper.js')}}"></script>
    <script src="{{asset('FrontEnd/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('FrontEnd/assets/js/jquery-ui.js')}}"></script>
    <script src="{{asset('FrontEnd/assets/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('FrontEnd/assets/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('FrontEnd/assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('FrontEnd/assets/js/waypoints.min.js')}}"></script>
    <script src="{{asset('FrontEnd/assets/js/ajax-mail.js')}}"></script>
    <script src="{{asset('FrontEnd/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('FrontEnd/assets/js/plugins.js')}}"></script>
    <script src="{{asset('FrontEnd/assets/js/main.js')}}"></script>
    <script src="{{asset('FrontEnd/assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>



    @yield('scripts')


    <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>

    @if(session()->get('cartNull'))
    <script>
        swal({
            title: "Ch?? ??"
            , text: '{{session()->get('
            cartNull ')}}'
            , icon: "warning",

        });

    </script>
    @endif

    @if(session()->get('changepassword'))
    <script>
        swal({
            title: "Th??ng b??o"
            , text: '{{session()->get('
            changepassword ')}}'
            , icon: "success",

        });

    </script>
    @endif
    <script type="text/javascript">
        //Remove item product from icon cart
        $("#change-item-cart").on("click", ".zmdi-delete", function(e) {
            e.preventDefault();
            let url = window.location.href;
            let route = url.split("cart", 1);
            let id = $(this).data("id");
            $.ajax({
                method: "GET"
                , url: "{{ route('remove.from.cart') }}"
                , data: {
                    id: id
                }
                , success: function(repsonse) {
                    $("#cart-icon").load(" #cart-icon");
                    $("#change-item-cart").load(" #change-item-cart");
                    $("#cart_table").load(" #cart_table");
                    $(".checkout-form").load(" .checkout-form");

                    alertify.set('notifier', 'position', 'bottom-right');
                    alertify.success('???? x??a s???n ph???m!');
                }
            });
        });

    </script>

</body>

</html>
