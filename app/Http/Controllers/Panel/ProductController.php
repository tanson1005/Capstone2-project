<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Products::with('productType')->get();

        return response()->view('panel.products.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productTypes = ProductType::all();

        return response()->view('panel.products.create', compact('productTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'product_name' => 'required|string',
            'product_symbol' => 'required|string',
            'product_price' => 'required|numeric',
            'product_image' => 'required|image',
            'product_description' => 'required|string',
            'product_link' => 'required|url',
            'product_type_id' => 'required',
        ];
        $request->validate($rules);
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('img/products', $filename);
        }

        Products::create([
            'product_name' => $request->product_name,
            'product_symbol' => $request->product_symbol,
            'product_price' => $request->product_price,
            'product_image' => $filename,
            'product_description' => $request->product_description,
            'product_link' => $request->product_link,
            'product_type_id' => $request->product_type_id,
            'active' => 1,
        ]);

        return redirect(route('products.index'))->with('success', 'Bạn đã thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Products::findOrFail($id);
        $productTypes = $data->productType->product_type_name;

        return response()->view('panel.products.showdetail', compact('productTypes', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productTypes = ProductType::all();
        $data = Products::findOrFail($id);

        return response()->view('panel.products.edit', compact('productTypes', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Products::find($id);
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('img/products', $filename);
        } else {
            $filename = $data->product_image;
        }
        $data->update([
            'product_name' => $request->product_name,
            'product_symbol' => $request->product_symbol,
            'product_price' => $request->product_price,
            'product_image' => $filename,
            'product_description' => $request->product_description,
            'product_link' => $request->product_link,
            'product_type_id' => $request->product_type_id,
            'active' => 1,
        ]);

        return redirect(route('products.index'))->with('success', 'Bạn đã thay đổi thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Products::findOrFail($id);
        $data->update(['active' => 0]);

        return redirect()->back()->with('success', 'Bạn đã xóa thành công');
    }
}
