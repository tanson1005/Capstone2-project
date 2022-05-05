@extends('layouts.frontend')
@section('styles')

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
@endsection
@section('content')
<!--breadcrumb area start-->
<div class=" breadcrumb_container container">
    <div class="row">
        <div class="col-12">
            <nav>
                <ul>
                    <li>
                        <a href="index.html">Trang chủ ></a>
                    </li>
                    <li>Thông tin sản phẩm</li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<!--breadcrumb area end-->


<!-- primary block area -->
<div class="table_primary_block pt-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <div class="product-flags">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tabone" role="tabpanel">
                            <div class="product_tab_img">
                                <a href="#"><img src="{{url('img/products',$product->product_image)}}" alt=""></a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabtwo" role="tabpanel">
                            <div class="product_tab_img">
                                <a href="#"><img src="../FrontEnd/assets/img/cart/nav11.jpg" alt=""></a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabthree" role="tabpanel">
                            <div class="product_tab_img">
                                <a href="#"><img src="../FrontEnd/assets/img/cart/nav13.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="products_tab_button">
                        <ul class="nav product_navactive" role="tablist">
                            <li class="product_button_one">
                                <a class="nav-link active" data-toggle="tab" href="#tabone" role="tab" aria-controls="imgeone" aria-selected="false"><img src="../FrontEnd/assets/img/cart/nav.jpg" alt=""></a>
                            </li>
                            <li>
                                <a class="nav-link" data-toggle="tab" href="#tabtwo" role="tab" aria-controls="imgetwo" aria-selected="false"><img src="../FrontEnd/assets/img/cart/nav1.jpg" alt=""></a>
                            </li>
                            <li>
                                <a class="nav-link" data-toggle="tab" href="#tabthree" role="tab" aria-controls="imgethree" aria-selected="false"><img src="../FrontEnd/assets/img/cart/nav2.jpg" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="product__details_content">
                    <div class="demo_product">
                        <h2>{{$product->product_name}}</h2>
                    </div>
                    <div class="current_price">
                        <span>{{number_format($product->product_price)}} Vnd</span>
                    </div>
                    <div class="product_information">
                        <div id="product_description_short">
                            @if (!empty($product->product_link))
                            QR Code: {!! QrCode::size(100)->generate(route('details.qr', ['id'=>$product->id])); !!}
                            @endif
                            {{ $product->product_description }}
                            <p>Sản phẩm được lựa chọn kỹ, cực kỳ chất lượng, đảm bảo an toàn thực phẩm.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- primary block end -->

<!-- product page tab -->

<div class="product_page_tab ptb-100" id="product_tab">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product_tab_button">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li>
                            <a class="tav_past" id="home-tab" data-toggle="tab" href="#map" role="tab" aria-controls="map" aria-selected="true">Nơi sản xuất sản phẩm</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="map" role="tabpanel">
                        <div class="product-description">
                            <iframe src="{{ $product->product_link }}" style="width: 100%; height: 600px; border:0;" allowfullscreen frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- product page tab end -->

@endsection
@section('scripts')
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
<script>
    @if(session()->get('vote'))

    swal({
        title: "Thành công"
        , text: '{{session()->get("vote")}}'
        , icon: "success",

    });


    @endif

    @if(session()->get('comment'))

    swal({
        title: "Thành công"
        , text: '{{session()->get("comment")}}'
        , icon: "success",

    });


    @endif

</script>

<script>
    //Add to cart index shop

    $("#add__Cart").on('click', function(e) {
        e.preventDefault();
        let url = window.location.href;
        let route = url.split("product-detail", 1)
        let id = $(this).data('id');
        let quantity = $(this).parents(".product_variants").find('input.quantity-detail').val();
        quanty = quantity;
        console.log(quantity);
        $.ajax({
            type: "GET"
            , url: route + "add-to-cart/" + id
            , data: {
                id: id
                , quantity: quanty
            }
            , success: function(repsonse) {
                $("#cart-icon").load(" #cart-icon");
                // $("#change-item-cart").html(repsonse);
                $("#change-item-cart").load(" #change-item-cart");
                alertify.set('notifier', 'position', 'bottom-right');
                alertify.success('Đã thêm sản phẩm!');
            }
        });
    });

    //Add to cart icon  related product

    $(".add_cart_related").on('click', function(e) {
        e.preventDefault();
        let url = window.location.href;
        let route = url.split("product-detail", 1)
        let id = $(this).data('id');
        let quantity = $(this).parents(".product__content").find('input.quantity-product-relate').val();
        console.log(quantity);
        $.ajax({
            type: "GET"
            , url: route + "add-to-cart/" + id
            , data: {
                id: id
                , quantity: quantity
            }
            , success: function(repsonse) {
                $("#cart-icon").load(" #cart-icon");
                $("#change-item-cart").load(" #change-item-cart");
                alertify.set('notifier', 'position', 'bottom-right');
                alertify.success('Đã thêm sản phẩm!');
            }
        });
    });

    //Add to cart modal related product

    $(".add_cart_relate").on('click', function(e) {
        e.preventDefault();
        let url = window.location.href;
        let route = url.split("product-detail", 1);
        let id = $(this).data("id");
        let quantity = $(this).parents(".quickview_plus_minus_inner").find('input.quantity_product').val();
        console.log(quantity);
        $.ajax({
            method: "GET"
            , url: route + "add-to-cart/" + id
            , data: {
                id: id
                , quantity: quantity
            }
            , success: function(data) {
                $("#cart-icon").load(" #cart-icon");
                $("#change-item-cart").load(" #change-item-cart");
                alertify.set('notifier', 'position', 'bottom-right');
                alertify.success('Đã thêm sản phẩm!');
            }
        });

    });

    // Add smooth scrolling to all links
    $(".comments_advices a").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;
            console.log(hash);

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, .breadcrumb_container').animate({
                scrollTop: $(hash).offset().top
            }, 800, function() {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        } // End if
    });

</script>

@endsection
