<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\OrderItemsmodel;
use App\Driver;
use App\Customer;
use App\Configuration;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function orders()
    {
		
		$orders          = Order::where('status', 'delivered')->orderBy('id','desc')->get();
		
        return view('admin.reports.orders', [
            'orders' => $orders,
            'orders_count' => Order::where('status', 'delivered')->count(),
        ]);

    }


    public function products()
    {
		$products          = Product::where('type', 'product')->orderBy('id','desc')->get();
		
        return view('admin.reports.products', [
            'products' => $products,
            'products_count' => Product::where('type', 'product')->count(),
        ]);
    }


    public function drivers()
    {
		$drivers         = Driver::orderBy('id','desc')->get();
		
        return view('admin.reports.drivers', [
            'drivers' => $drivers,
            'drivers_count' => Driver::all()->count(),
        ]);
    }


    public function customers()
    {
		$customers         = Customer::orderBy('id','desc')->get();
		
        return view('admin.reports.customers', [
            'customers' => $customers,
            'customers_count' => Customer::all()->count(),
        ]);
    }

    
 
}
