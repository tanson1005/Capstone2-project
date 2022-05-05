<?php

namespace App\Http\Controllers\Panel;

use App\HelpersClass\Date;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Orders;
use App\Models\Products;
use App\Models\User;
use App\Models\Comments;
use App\Models\WareHouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SinglePageController extends Controller
{
    public function index()
    {
        // Set rolename is admin or employee to access into index page
        if (Auth::user()->rolename == 'admin' || Auth::user()->rolename == 'Nhân viên') {

            //Users
            $user = User::all();
            foreach ($user as $item) {
                if ($item->rolename == "admin") {
                    $user = $item->name;
                }
            }

            $consignments = WareHouse::where('consignment_currently', '<', 100)
                ->select(
                    'id',
                    'consignment_name',
                    'consignment_currently',
                    'consignment_quantity',
                    'updated_at',
                )
                ->get();
            session()->put('consignments', $consignments);

            //Total orders
            $totalOrders = Orders::all()->where('id')->count();
            //Customers
            $totalCustomers = Customer::all()->where('id')->count();
            //Total products
            $totalProducts = Products::all()->where('id')->count();
            //Order status
            $orderStatus = Orders::all()->where('order_status');
            //Comments
            $totalComments = Comments::all()->where('id')->count();

            $listday = Date::getListDayInMonth();

            //Thống kê trạng thái đơn hàng
            //Tiếp nhận
            $statusDefault = Orders::where('order_status', 'Tiếp nhận')->select('id')->count();
            //Tiếp nhận
            $statusSuccess = Orders::where('order_status', 'Đã giao')->select('id')->count();
            //Tiếp nhận
            $statusProcess = Orders::where('order_status', 'Đang giao')->select('id')->count();
            //Tiếp nhận
            $statusCancel = Orders::where('order_status', 'Hủy')->select('id')->count();

            $status_order = [
                [
                    'Đã giao', $statusSuccess, false,
                ],
                [
                    'Tiếp nhận', $statusDefault, false,
                ],
                [
                    'Đang giao', $statusProcess, false,
                ],
                [
                    'Hủy', $statusCancel, false,
                ],
            ];

            // Doanh thu theo thang ứng với trạng thái đã giao
            $revenueOrderMonth = Orders::where('order_status', 'Đã giao')
                ->whereMonth('created_at', date('m'))
                ->select('order_total_price', DB::raw('DATE(created_at) AS day'))
                ->groupBy('order_total_price', 'day')->get()->toArray();

            // Doanh thu theo thang ứng với trạng thái tiếp nhận
            $revenueOrderMonthDefault = Orders::where('order_status', 'Tiếp nhận')
                ->whereMonth('created_at', date('m'))
                ->select('order_total_price', DB::raw('DATE(created_at) AS day'))
                ->groupBy('order_total_price', 'day')->get()->toArray();

            // Doanh thu theo thang ứng với trạng thái Đang giao
            $revenueOrderMonthProcess = Orders::where('order_status', 'Đang giao')
                ->whereMonth('created_at', date('m'))
                ->select('order_total_price', DB::raw('DATE(created_at) AS day'))
                ->groupBy('order_total_price', 'day')->get()->toArray();
            // Doanh thu theo thang ứng với trạng thái Hủy
            $revenueOrderMonthCancel = Orders::where('order_status', 'Hủy')
                ->whereMonth('created_at', date('m'))
                ->select('order_total_price', DB::raw('DATE(created_at) AS day'))
                ->groupBy('order_total_price', 'day')->get()->toArray();

            $arrayRevenueOrderMonth = [];
            $arrayRevenueOrderMonthDefault = [];
            $arrayRevenueOrderMonthProcess = [];
            $arrayRevenueOrderMonthCancel = [];

            foreach ($listday as $day) {
                //Đã giao
                $total = 0;
                foreach ($revenueOrderMonth as $key => $revenue) {
                    if ($revenue['day'] == $day) {
                        $total += $revenue['order_total_price'];
                    }
                }
                $arrayRevenueOrderMonth[] = (int) $total;

                //tiếp nhận
                $total = 0;
                foreach ($revenueOrderMonthDefault as $key => $revenue) {
                    if ($revenue['day'] == $day) {
                        $total = $revenue['order_total_price'];
                    }
                }
                $arrayRevenueOrderMonthDefault[] = (int) $total;

                //đang giao
                $total = 0;
                foreach ($revenueOrderMonthProcess as $key => $revenue) {
                    if ($revenue['day'] == $day) {
                        $total = $revenue['order_total_price'];
                    }
                }
                $arrayRevenueOrderMonthProcess[] = (int) $total;

                //hủy
                $total = 0;
                foreach ($revenueOrderMonthCancel as $key => $revenue) {
                    if ($revenue['day'] == $day) {
                        $total = $revenue['order_total_price'];
                    }
                }
                $arrayRevenueOrderMonthCancel[] = (int) $total;
            }

            //Danh sach don hang moi nhat
            $orders = Orders::orderByDesc('id')->simplepaginate(7);

            $viewData = [
                'user' => $user,
                'totalOrders' => $totalOrders,
                'totalCustomers' => $totalCustomers,
                'totalProducts' => $totalProducts,
                'orderStatus' => $orderStatus,
                'totalComments'     =>  $totalComments,
                'orders' => $orders,
                'listday' => json_encode($listday),
                'status_order' => json_encode($status_order),
                'arrayRevenueOrderMonth' => json_encode($arrayRevenueOrderMonth),
                'arrayRevenueOrderMonthDefault' => json_encode($arrayRevenueOrderMonthDefault),
                'arrayRevenueOrderMonthProcess' => json_encode($arrayRevenueOrderMonthProcess),
                'arrayRevenueOrderMonthCancel' => json_encode($arrayRevenueOrderMonthCancel),
            ];

            return view('panel.index',
                compact(
                    'user',
                    'totalOrders',
                    'totalCustomers',
                    'totalProducts',
                    'orderStatus',
                    'totalComments',
                    'orders',
                    'listday',
                    'status_order',
                    'arrayRevenueOrderMonth',
                    'arrayRevenueOrderMonthDefault',
                    'arrayRevenueOrderMonthProcess',
                    'arrayRevenueOrderMonthCancel'
                ));
        } else { // if rolename is not admin or employee then logout and show message errors
            Auth::logout();
            return redirect('/')->withErrors('Thông tin đăng nhập không đúng.');
        }
    }
}
