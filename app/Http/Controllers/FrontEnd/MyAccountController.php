<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MyAccountController extends Controller
{
    public function get()
    {
        $customer = Customer::where('user_id', (int) Auth()->user()->id)->first();
        $orders = Orders::where('customer_id', (int) $customer->id)->get();
        foreach ($orders as $id => $order) {
            $dataOrders[$order->id] = OrderDetails::join('orders', 'orders.id', '=', 'orderdetails.orders_id')
            ->join('products', 'products.id', '=', 'orderdetails.product_id')
            ->where('orders.id', '=', (int) $order->id)
            ->select(
                'orderdetails.orders_id',
                'orderdetails.order_detail_quantity',
                'orderdetails.order_detail_price',
                'orders.order_total_price',
                'orders.created_at',
                'orderdetails.id',
                'products.product_symbol',
                'products.product_name',
                'products.product_description',
                )
                ->get();
        }
        $products = OrderDetails::whereIn('orders_id', $orders->pluck('id'))->select('product_id')->with('getProduct')->groupBy('product_id')->get();
        // dd($products);
        // dd($dataOrders);
        return view('frontend.auth.myaccount', compact('orders', 'dataOrders', 'products'));
    }

    public function post(Request $request)
    {
        $request->validate([
            'password' => 'nullable|string|confirmed',
        ]);

        if (isset($request->old_password) || isset($request->password) || isset($request->password_confirmation)) {
            if (Hash::check($request->old_password, auth()->user()->password)) {
                $password = Hash::make($request->password);
                $update['password'] = $password;
            } else {
                return redirect()->back()->with('message', 'Mật khẩu không đúng');
            }
        }
        $user = User::find(auth()->user()->id);
        $user->update($update);

        return redirect()->route('logout');
    }

    // Display details information of customer
    // public function haveOrdered($id)
    // {

    //     $id = Auth()->user()->id;
    //     $customer = Customer::find((int) $id);

    //     $dataOrders = OrderDetails::join('orders', 'orders.id', '=', 'orderdetails.orders_id')
    //         ->join('products', 'products.id', '=', 'orderdetails.product_id')
    //         ->where('orders.id', '=', $id)
    //         ->select(
    //             'orderdetails.order_detail_quantity',
    //             'orderdetails.order_detail_price',
    //             'orders.created_at',
    //             'products.product_symbol',
    //             'products.product_name',
    //             'products.product_description',
    //         )
    //         ->get();
    //     dd($dataOrders);
    //     // return response()->view('frontend.auth.myaccount', [
    //     //     'customer' => $customer,
    //     //     'dataOrders' => $dataOrders,
    //     // ]);

    // }
}
