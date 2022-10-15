<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseStoreRequest;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderStatusTypeChange;
use App\Models\PurchaseOrderStatusType;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(Request $request) {
        $purchases = new PurchaseOrder();
        if($request->start_date) {
            $purchases = $purchases->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date) {
            $purchases = $purchases->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }
        if(auth()->user()->role == "merchant" || auth()->user()->role == "supplier") {
            $purchases = $purchases->where('user_id', '=', auth()->user()->id);
        }
        $purchases = $purchases->with(['items', 'payments', 'supplier', 'user'])->latest()->paginate(10);         

        $total = $purchases->map(function($i) {
            return $i->total();
        })->sum();

        $tax_total = 0.16 * $total;

        $receivedAmount = $purchases->map(function($i) {
            return $i->receivedAmount();
        })->sum();

        return view('purchases.index', compact('purchases', 'total', 'tax_total', 'receivedAmount'));
    }

    public function store(PurchaseStoreRequest $request)
    {
        $purchase = PurchaseOrder::create([
            'supplier_id' => $request->supplier_id,
            'merchant_id' => auth()->user()->id,
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'description' => $request->description,
            'expected_delivery_date' => $request->expected_delivery_date
        ]);

        $cart = $request->user()->cart()->get();
        foreach ($cart as $item) {
            $purchase->items()->create([
                'price' => $item->price * $item->pivot->quantity,
                'quantity' => $item->pivot->quantity,
                'product_id' => $item->id,
            ]);
            $item->quantity = $item->quantity - $item->pivot->quantity;
            $item->save();
        }
        $request->user()->cart()->detach();
        $purchase->payments()->create([
            'amount' => $request->amount,
            'user_id' => $request->user()->id,
        ]);
        return 'success';
    }

    public function statusChange($purchaseOrderId, $status, $reason="")
    {
        $purchaseorder = PurchaseOrder::where('id', $purchaseOrderId)->first();
        $purchaseorder->updateStatus($status, $reason);

        return response()->json(['info' => 'success', 'message' => 'PurchaseOrder ' . $status]);
    }

    public function confirm(){
        return view('confirm');
    }
}
