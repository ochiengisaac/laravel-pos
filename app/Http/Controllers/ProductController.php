<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Contact;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $account_id = auth()->user()->id;

        if(auth()->user()->role === "assistant"){
            $account_id = auth()->user()->account_id;
        }

        $products = new Product();
        if ($request->search) {
            $products = $products->where('name', 'LIKE', "%{$request->search}%");
        }
        if(auth()->user()->role === "merchant" || auth()->user()->role === "supplier"  || auth()->user()->role === "assistant"){
            $products = $products->where("account_id", "=", $account_id);
        }
        $products = $products->latest()->paginate(10);
        if (request()->wantsJson()) {
            return ProductResource::collection($products);
        }
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = User::where("role", "=", "supplier")->where("kyc_completed", "=", 1)->latest()->paginate(10);
        return view('products.create')->with('suppliers', $suppliers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $account_id = auth()->user()->id;

        if(auth()->user()->role === "assistant"){
            $account_id = auth()->user()->account_id;
        }

        $image_path = '';

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('products', 'public');
        }

        $request_account_id = $request->account_id;

        if(!empty($request_account_id)){
            $account_id = $request_account_id;
        }

        $user_id = auth()->user()->id;

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $image_path,
            'barcode' => $request->barcode,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'user_id' => $user_id,
            'account_id' => $account_id
        ]);

        if (!$product) {
            return redirect()->back()->with('error', 'Sorry, there a problem while creating product.');
        }
        return redirect()->route('products.index')->with('success', 'Success, you product has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $suppliers = User::where("role", "=", "supplier")->where("kyc_completed", "=", 1)->latest()->paginate(10);
        return view('products.edit')->with('product', $product)->with('suppliers', $suppliers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $account_id = auth()->user()->id;

        if(auth()->user()->role === "assistant"){
            $account_id = auth()->user()->account_id;
        }

        $request_account_id = $request->account_id;

        if(!empty($request_account_id)){
            $product->account_id = $request_account_id;
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->barcode = $request->barcode;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->status = $request->status;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::delete($product->image);
            }
            // Store image
            $image_path = $request->file('image')->store('products', 'public');
            // Save to Database
            $product->image = $image_path;
        }

        if (!$product->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating product.');
        }
        return redirect()->route('products.index')->with('success', 'Success, your product have been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
