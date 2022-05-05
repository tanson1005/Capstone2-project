@extends('layouts.frontend')
@section('styles')
<!-- Css Alert -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
<!-- Semantic UI theme -->
{{-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" /> --}}
@endsection
@section('content')

<!-- Nav Page start-->

<div class="container">
    <div class="breadcrumb_container">
        <div class="row">
            <div class="col-12">
                <nav>
                    <ul>
                        <li>
                            <a href="{{route('frontend.index')}}">Trang chủ ></a>
                        </li>
                        <li>Giỏ Hàng</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!--- Nav Page end -->

<div class="cart_main_area ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="cart_table">
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table data-url="{{ route('update.cart') }}" class="update_cart_url">
                                <thead>
                                    <tr>
                                        <th class="img-thumbnail">Ảnh</th>
                                        <th class="product-name">Sản Phẩm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product-quantity">Số lượng</th>
                                        <th class="product-subtotal">Tổng tiền</th>
                                        <th class="product-remove">Chỉnh sửa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0; $cartTotal= 0;  @endphp
                                    @if (session()->get('cart') !== null)
                                    @foreach ($carts = session()->get('cart') as $id=>$cart )

                                    <tr data-id="{{ $id }}">
                                        <td class="product-thumbnail"><img src="{{url('/img/products',$cart['image'])}}"
                                                width="70px" height="auto" alt=""></td>
                                        <td class="product-name"><a href="#">{{$cart['name']}}</a></td>
                                        <td class="product-price"><span
                                                class="amount">{{number_format($cart['price'])}}</span></td>
                                        <td data-th="Quantity" class="product-quantity">
                                            <div class="quickview_plus_minus quick_cart">
                                                <div class="quickview_plus_minus_inner">
                                                    <div class="cart-plus-minus cart_page">
                                                        <input type="number" min="1" value="{{ $cart['quantity'] }}"
                                                            class="form-control quantity " />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        @php
                                        $total = $cart['price'] * $cart['quantity'];
                                        $cartTotal += $total;
                                        @endphp
                                        <td class="product-subtotal">{{number_format($total)}}</td>
                                        <td class="product-update">
                                            <a href="javascript:" data-id="{{$id}}"
                                                class="badge badge-primary update-cart mr-5">U</a>
                                            <a href="javascript:" data-id="{{$id}}"
                                                class="badge badge-danger remove-from-cart">X</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row table-responsive_bottom">
                            <div class="col-lg-7 col-sm-7 col-md-7">
                                <div class="buttons-carts">
                                    {{-- <input value="Update Cart" type="submit"> --}}
                                    <a href="{{route('shop.index')}}">Tiếp tục mua hàng</a>
                                </div>
                                {{-- <div class="buttons-carts coupon">
                                <h3>Coupon</h3>
                                <p>Enter your coupon code if you have one.</p>
                                <input placeholder="Coupon code" type="text">
                                <input value="Apply Coupon" type="submit">
                            </div> --}}
                            </div>
                            <div class="col-lg-5 col-sm-5 col-md-5">
                                <div class="cart_totals  text-right">
                                    <h2>Tổng đơn hàng</h2>
                                    <div class="cart-subtotal">
                                        <span>Tổng tiền sản phẩm</span>
                                        <span>{{number_format($cartTotal)}}Vnd</span>
                                    </div>
                                    <div class="order-total">
                                        <span><strong>Tổng tiền (phụ phí)</strong> </span>
                                        <span><strong>{{number_format($cartTotal)}}Vnd</strong> </span>
                                    </div>
                                    <div class="wc-proceed-to-checkout">
                                        <a href="{{route('checkout.cart')}}">Tiến hành Thanh toán</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<!-- JavaScript alert-->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


<script type="text/javascript">
    //Update item cart
    function cartUpdate(e) {
        e.preventDefault();
        let urlUpdateCart = $('.update_cart_url').data('url');
        let id = $(this).data('id');
        let quantity = $(this).parents('tr').find('input.quantity').val();
        $.ajax({
            type: "GET",
            url: urlUpdateCart,
            data: {
                id: id,
                quantity: quantity
            },
            success: function (data) {
                $("#cart-icon").load(" #cart-icon");
                alertify.set('notifier', 'position', 'top-center');
                alertify.success('You have successfully updated!');
            }
        });
    }
    $(function () {
        $('.update-cart').on('click', cartUpdate);
    });

    // Remove item cart
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        // var closable = alertify.alert().setting('closable');
        //grab the dialog instance using its parameter-less constructor then set multiple settings at once.
        if (alertify.alert()
            .setting({
                'label': 'Đúng',
                'message': 'Bạn muốn xóa sản phẩm này?',
                'onok': function () {
                    $.ajax({
                        url:'{{route('remove.from.cart')}}',
                        method: "GET",
                        data: {
                            // _token: '{{ csrf_token() }}',
                            id: ele.parents("tr").attr("data-id")
                        },
                        success: function (response) {
                            $("#cart-icon").load(" #cart-icon");
                            $("#change-item-cart").load(" #change-item-cart");
                            $("#cart_table").load(" #cart_table");
                            alertify.set('notifier', 'position', 'top-center');
                            alertify.success('Đã xóa sản phẩm!');
                        }
                    });
                }
            }).show()) {

        }

    });
</script>
@endsection
