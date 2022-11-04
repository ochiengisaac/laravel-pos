<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\AllAccountDataController;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $summaryData = AllAccountDataController::getAnalyticsData();        
        return view('home', [
            'incomingOrders' => $summaryData['incomingOrders'],
            'outgoingOrders' => $summaryData['outgoingOrders'],
            'suppliers' => $summaryData['suppliers'],
            'favoriteSuppliers' => $summaryData['favoriteSuppliers'],
            'customers' => $summaryData['customers'],
            'favoriteCustomers' => $summaryData['favoriteCustomers'],
            'total_purchases' => $summaryData['total_purchases'],
            'total_sales' => $summaryData['total_sales'],
            'customersCount' => $summaryData['customersCount'],
            'suppliersCount' => $summaryData['suppliersCount'],
            'incomingOrdersCount' => $summaryData['incomingOrdersCount'],
            'outgoingOrdersCount' => $summaryData['outgoingOrdersCount'],
            'incomeToday' => $summaryData['incomeToday'],
            'profitTotal' => $summaryData['profitTotal']
        ]);
    }
}
