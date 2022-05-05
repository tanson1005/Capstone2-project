<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use App\Models\Customer;
use App\Models\GroupGoods;
use App\Models\Products;
use App\Models\Vote;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::withAvg('votes', 'point')->withCount('comments')->orderByDesc('votes_avg_point', 'comments_count')->limit(5)->get();
        $product = $products->first();
        $vegetables1 = Products::where('product_type_id', '=', 9)->limit(4)->get();
        $vegetables2 = Products::orderby('id', 'desc')->where('product_type_id', '=', 9)->limit(4)->get();
        $rices1 = Products::where('product_type_id', '=', 3)->limit(4)->get();
        $rices2 = Products::orderby('id', 'desc')->where('product_type_id', '=', 7)->limit(4)->get();
        $flowers1 = Products::where('product_type_id', '=', 2)->limit(4)->get();
        $flowers2 = Products::orderby('id', 'desc')->where('product_type_id', '=', 6)->limit(4)->get();

        return view('frontend.index',
                compact(
                    'products',
                    'product',
                    'vegetables1',
                    'vegetables2',
                    'rices1',
                    'rices2',
                    'flowers1',
                    'flowers2',
                ));
    }

    //Show shop
    public function shop()
    {
        $categorys = GroupGoods::whereIn('id', [1, 2, 3])->get();

        $products = Products::latest('id', 'DESC')->get();

        // Sap xep san pham

        $min_price = Products::min('product_price');
        $max_price = Products::max('product_price');

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];

            if ($sort_by == 'price_ASC') {
                $products = Products::orderBy('product_price', 'asc')->get();
            } elseif ($sort_by == 'price_DESC') {
                $products = Products::orderBy('product_price', 'desc')->get();
            } elseif ($sort_by == 'kytu_ASC') {
                $products = Products::orderBy('product_name', 'asc')->get();
            } elseif ($sort_by == 'kytu_DESC') {
                $products = Products::orderBy('product_name', 'desc')->get();
            }
        }

        // Loc san pham

        elseif (isset($_GET['start_price']) && $_GET['end_price']) {
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];
            $products = Products::whereBetween('product_price', [$min_price, $max_price])
            ->orderBy('product_price', 'asc')->get();
        } else {
            $products = Products::latest('id')->get();
        }

        return view('frontend.cart.shop',
        compact(
            'categorys',
            'products',
            // 'totalProducts',
            'min_price',
            'max_price'
        ));
    }

    //Search products
    public function getSearch(Request $request)
    {
        //list category
        $categorys = GroupGoods::whereIn('id', [1, 2, 3])->get();

        //Search product
        $products = Products::where('product_name', 'like', '%'.$request->search.'%')
                                 ->orWhere('product_price', $request->search)->latest('id')->get();

        //Tong san pham
        $totalProducts = Products::all()->where('id')->count();

        // Sap xep san pham

        $min_price = Products::min('product_price');
        $max_price = Products::max('product_price');

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];

            if ($sort_by == 'price_ASC') {
                $products = Products::orderBy('product_price', 'asc')->get();
            } elseif ($sort_by == 'price_DESC') {
                $products = Products::orderBy('product_price', 'desc')->get();
            } elseif ($sort_by == 'kytu_ASC') {
                $products = Products::orderBy('product_name', 'asc')->get();
            } elseif ($sort_by == 'kytu_DESC') {
                $products = Products::orderBy('product_name', 'desc')->get();
            }
        }

        // Loc san pham

        elseif (isset($_GET['start_price']) && $_GET['end_price']) {
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];
            $products = Products::whereBetween('product_price', [$min_price, $max_price])
            ->orderBy('product_price', 'asc')->get();
        } else {
            $products = Products::where('product_name', 'like', '%'.$request->search.'%')
                                 ->orWhere('product_price', $request->search)->latest('id')->get();
        }

        return view('frontend.cart.shop',
        compact(
            'categorys',
            'products',
            'totalProducts',
            'min_price',
            'max_price'
        ));
    }

    //Danh muc
    public function show_danhmuc($product_type_name, $id)
    {
        $categorys = GroupGoods::whereIn('id', [1, 2, 3])->get();

        $products = Products::where('product_type_id', $id)->get();

        //Tong san pham
        $totalProducts = Products::all()->where('id')->count();

        // Sap xep san pham

        $min_price = Products::min('product_price');
        $max_price = Products::max('product_price');

        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];

            if ($sort_by == 'price_ASC') {
                $products = Products::orderBy('product_price', 'asc')->get();
            } elseif ($sort_by == 'price_DESC') {
                $products = Products::orderBy('product_price', 'desc')->get();
            } elseif ($sort_by == 'kytu_ASC') {
                $products = Products::orderBy('product_name', 'asc')->get();
            } elseif ($sort_by == 'kytu_DESC') {
                $products = Products::orderBy('product_name', 'desc')->get();
            }
        }

        // Loc san pham

        elseif (isset($_GET['start_price']) && $_GET['end_price']) {
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];
            $products = Products::whereBetween('product_price', [$min_price, $max_price])
            ->orderBy('product_price', 'asc')->get();
        } else {
            $products = Products::where('product_type_id', $id)->get();
        }

        return view('frontend.cart.shop',
        compact(
            'categorys',
            'products',
            'totalProducts',
            'min_price',
            'max_price'
        ));
    }

    public function detailsProduct($id)
    {
        $product = Products::find($id);
        $votes = Vote::where('product_id', $id)->get();
        $voteCount = $votes->count();
        $votePoint = round($votes->avg('point'));
        $comments = Comments::orderby('id', 'desc')->where('product_id', (int) $product->id)->get();
        $type_id = $product->product_type_id;
        $relatedProduct = Products::join('product_types', 'product_types.id', '=', 'products.product_type_id')
            ->where('product_types.id', '=', $type_id)
            ->select('products.id',
                    'products.product_name',
                    'products.product_image',
                    'products.product_price',
                    'products.product_description')
            ->get();

        return view('frontend.cart.product-detail', compact('product', 'voteCount', 'votePoint', 'comments', 'relatedProduct'));
    }

    public function detailsQR($id)
    {
        $product = Products::find($id);

        return view('frontend.cart.qr-detail', compact('product'));
    }

    public function voteProduct(Request $request, $id)
    {
        if ($point = $request->point) {
            if ($point >= 0 && $point <= 5) {
                $product = Products::findOrFail($id);
                $customer = Customer::where('user_id', auth()->id())->firstOrFail();
                $vote = Vote::updateOrCreate([
                    'customer_id' => $customer->id,
                    'product_id' => $id,
                ], [
                    'point' => $point,
                ]);
                $vote->save();

                return redirect()->back()->with('vote', 'Bạn đã đánh giá sản phẩm thành công');
            }
        }

        return redirect()->back();
    }

    public function addToCart1(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            ++$cart[$id]['quantity'];
        } else {
            $cart[$id] = [
                'name' => $product->product_name,
                'quantity' => $request->quantity,
                'price' => $product->product_price,
                'image' => $product->product_image,
                'des' => $product->product_description,
            ];
        }

        session()->put('cart', $cart);
    }

    public function showCart()
    {
        $carts = session()->get('cart');

        return response()->view('frontend.cart.cart', compact('carts'));
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
    }

    public function checkout()
    {
        if (session()->get('cart') != null) {
            $carts = session()->get('cart');

            return view('frontend.checkout.checkout', compact('carts'));
        } else {
            return redirect()->back()->with('cartNull', 'Giỏ hàng rỗng, vui lòng chọn sản phẩm!');
        }
    }
}
