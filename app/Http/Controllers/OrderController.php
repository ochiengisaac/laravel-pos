<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\OrderUpdateRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request) {
        $account_id = auth()->user()->id;

        if(auth()->user()->role === "assistant"){
            $account_id = auth()->user()->account_id;
        }

        $orders = new Order();
        if($request->start_date) {
            $orders = $orders->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $orders = $orders->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }
        $orders = $orders->where('account_id', '=', $account_id);

        $orders = $orders->with(['items', 'payments'])->latest()->paginate(10);

        $total = $orders->map(function($i) {
            return $i->total();
        })->sum();
        $sumOfPaymentsAmount = $orders->map(function($i) {
            return $i->sumOfPaymentsAmount();
        })->sum();

        return view('orders.index', compact('orders', 'total', 'sumOfPaymentsAmount'));
    }

    public function store(OrderStoreRequest $request)
    {
        $account_id = auth()->user()->id;

        if(auth()->user()->role === "assistant"){
            $account_id = auth()->user()->account_id;
        }
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'user_id' => $request->user()->id,
            'account_id' => $account_id
        ]);

        $cart = $request->user()->cart()->get();
        foreach ($cart as $item) {
            $order->items()->create([
                'price' => $item->price * $item->pivot->quantity,
                'quantity' => $item->pivot->quantity,
                'order_id' => $item->id,
                'product_id' => $item->pivot->product_id,
            ]);
            $item->quantity = $item->quantity - $item->pivot->quantity;
            $item->save();
        }
        $request->user()->cart()->detach();
        $order->payments()->create([
            'amount' => $request->amount,
            'user_id' => $request->user()->id,
        ]);
        return 'success';
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit')->with('order', $order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        $order->name = $request->name;
        $order->description = $request->description;
        $order->barcode = $request->barcode;
        $order->price = $request->price;
        $order->quantity = $request->quantity;
        $order->status = $request->status;

        if (!$order->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating order.');
        }
        return redirect()->route('orders.index')->with('success', 'Success, your order have been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function confirm(){
        return view('confirm');
    }
}
