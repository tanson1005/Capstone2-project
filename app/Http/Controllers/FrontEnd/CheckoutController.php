<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function payment(Request $request)
    {
        if (Auth()->user() != null) {
            $customer = Customer::where('user_id', (int) Auth()->user()->id)->first();
        } else {
            $rule = [
                'name' => 'required|string',
                'phone' => 'required|string|unique:users,phone',
                'address' => 'required|string',
                'email' => 'required|email|unique:users,email',
            ];
            $request->validate($rule);

            $customer = Customer::create([
                'customer_name' => $request->name,
                'customer_phone' => $request->phone,
                'customer_email' => $request->email,
                'customer_address' => $request->address,
                'active' => 1,
            ]);
        }

        $totalPrice = 0;
        foreach (session()->get('cart') as $id => $cart) {
            $totalPrice += $cart['price'] * $cart['quantity'];
        }

        $order = Orders::create([
            'order_customer_name' => $customer->customer_name,
            'order_customer_phone' => $customer->customer_phone,
            'order_customer_email' => $customer->customer_email,
            'order_customer_address' => $customer->customer_address,
            'order_total_price' => $totalPrice,
            'order_detail' => json_encode(session()->get('cart')),
            'customer_id' => (int) $customer->id,
            'active' => 1,
            'order_status' => 'Tiếp nhận',
        ]);
        foreach (session()->get('cart') as $id => $cart) {
            $product = Products::find($id);
            $productId = $product->id;

            OrderDetails::create([
                'product_id' => (int) $productId,
                'orders_id' => (int) $order->id,
                'order_detail_quantity' => $cart['quantity'],
                'order_detail_price' => $cart['price'] * $cart['quantity'],
                'active' => 1,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('shop.index')->with('orders', 'Đơn hàng của bạn đã được đặt');
    }

    public function payOnline()
    {
        if (Auth()->user() != null) {
            return view('frontend.checkout.payOnline');
        } else {
            return redirect()->back()->with('payOnline', 'Đăng nhập để thực hiện thanh toán');
        }
    }

    public function viewCreditCard()
    {
        return view('frontend.checkout.creditCard');
    }

    public function payCreditCard(Request $request)
    {
        $customer = Customer::where('user_id', (int) Auth()->user()->id)->first();

        $totalPrice = 0;
        foreach (session()->get('cart') as $id => $cart) {
            $totalPrice += $cart['price'] * $cart['quantity'];
        }

        $order = Orders::create([
            'order_customer_name' => $customer->customer_name,
            'order_customer_phone' => $customer->customer_phone,
            'order_customer_email' => $customer->customer_email,
            'order_customer_address' => $customer->customer_address,
            'order_note' => 'Thanh toán online',
            'order_total_price' => $totalPrice,
            'customer_id' => (int) $customer->id,
            'active' => 1,
            'order_status' => 'Tiếp nhận',
        ]);
        foreach (session()->get('cart') as $id => $cart) {
            $product = Products::find($id);
            $productId = $product->id;

            OrderDetails::create([
                'product_id' => (int) $productId,
                'orders_id' => (int) $order->id,
                'order_detail_quantity' => $cart['quantity'],
                'order_detail_price' => $cart['price'] * $cart['quantity'],
                'active' => 1,
            ]);
        }
        session()->forget('cart');

        return redirect()->route('shop.index')->with('orders', 'Đơn hàng của bạn đã được đặt');
    }
}
