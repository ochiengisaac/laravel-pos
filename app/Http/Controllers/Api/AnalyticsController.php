<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Retrieve analytics.
     *
     * @return JSON response
     */
    public function index()
    {
        $currencySymbol = config('settings.currency_symbol', 'ZAR');
        //there can be assistants acting on behalf of account owner , so auth()->user() may not necessarily be the 
        //merchant or supplier who registered
        $account_id = auth()->user()->id;

        if(auth()->user()->role === "assistant"){
            $account_id = auth()->user()->account_id;
        }

        $incomingOrders = Order::with(['items', 'payments'])->where("direction", "=", "incoming")->where("supplier_id", "=", $account_id)->get();
        $outgoingOrders = Order::with(['items', 'payments'])->where("direction", "=", "outgoing")->where("customer_id", "=", $account_id)->get();
        
        $customers = Contact::where("deleted", "=", 0)->where("account_id", "=", $account_id)->where("contact_type", "=", "customer")->get();
        
        $customers_count = $customers->count();

        $purchasesTotalCost = $outgoingOrders->map(function($i) {
            if($i->sumOfPaymentsAmount() > $i->total()) {
                return $i->total();
            }
            return $i->sumOfPaymentsAmount();
        })->sum();

        $salesTotal = $incomingOrders->map(function($i) {
            if($i->sumOfPaymentsAmount() > $i->total()) {
                return $i->total();
            }
            return $i->sumOfPaymentsAmount();
        })->sum();

        
        $customersCount = $customers_count.'';
        $incomeToday = $incomingOrders->where('created_at', '>=', date('Y-m-d').' 00:00:00')->map(function($i) {
            if($i->sumOfPaymentsAmount() > $i->total()) {
                return $i->total();
            }
            return $i->sumOfPaymentsAmount();
        })->sum();

        $profitTotal = $salesTotal - $purchasesTotalCost;

        $incomingOrdersCount = ''.$incomingOrders->count();
        $outgoingOrdersCount = ''.$outgoingOrders->count();

        return response()->json([
            'total_purchases' => $currencySymbol." ".$purchasesTotalCost,
            'total_sales' => $currencySymbol." ".$salesTotal,
            'customersCount' => $customersCount,
            'incomingOrdersCount' => $incomingOrdersCount, 
            'outgoingOrdersCount' => $outgoingOrdersCount,
            'incomeToday' => $currencySymbol." ".$incomeToday,
            'profitTotal' => $currencySymbol." ".$profitTotal
        ]);

    }
}
