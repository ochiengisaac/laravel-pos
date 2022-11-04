<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseOrderStoreRequest;
use App\Http\Requests\PurchaseOrderUpdateRequest;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(Request $request) {
        $purchaseOrders = new PurchaseOrder();
        if($request->start_date) {
            $purchaseOrders = $purchaseOrders->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $purchaseOrders = $purchaseOrders->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }
        $purchaseOrders = $purchaseOrders->with(['items', 'payments'])->latest()->paginate(10);

        $total = $purchaseOrders->map(function($i) {
            return $i->total();
        })->sum();
        $sumOfPaymentsAmount = $purchaseOrders->map(function($i) {
            return $i->sumOfPaymentsAmount();
        })->sum();

        return view('purchaseOrders.index', compact('purchaseOrders', 'total', 'sumOfPaymentsAmount'));
    }

    public function store(PurchaseOrderStoreRequest $request)
    {
        $purchaseOrder = PurchaseOrder::create([
            'supplier_id' => $request->supplier_id,
            'subject' => $request->subject,
            'description' => $request->description,
            'expected_delivery_date' => $request->expected_delivery_date,
            'user_id' => $request->user()->id,
        ]);

        $cart = $request->user()->cart()->get();
        foreach ($cart as $item) {
            $purchaseOrder->items()->create([
                'price' => $item->price * $item->pivot->quantity,
                'quantity' => $item->pivot->quantity,
                'purchaseOrder_id' => $item->id,
                'product_id' => $item->pivot->product_id,
            ]);
            $item->quantity = $item->quantity - $item->pivot->quantity;
            $item->save();
        }
        $request->user()->cart()->detach();
        $purchaseOrder->payments()->create([
            'amount' => $request->amount,
            'user_id' => $request->user()->id,
        ]);
        return 'success';
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        return view('purchaseOrders.edit')->with('purchaseOrder', $purchaseOrder);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseOrderUpdateRequest $request, PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->name = $request->name;
        $purchaseOrder->description = $request->description;
        $purchaseOrder->barcode = $request->barcode;
        $purchaseOrder->price = $request->price;
        $purchaseOrder->quantity = $request->quantity;
        $purchaseOrder->status = $request->status;

        if (!$purchaseOrder->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating purchaseOrder.');
        }
        return redirect()->route('purchaseOrders.index')->with('success', 'Success, your purchaseOrder have been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();

        return response()->json([
            'success' => true
        ]);
    }

    public function confirm(){
        return view('confirm');
    }
}
