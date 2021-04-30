<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\OrderItemsmodel;
use App\Driver;
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



    //======== Get Order Details ======== 
    public function getorderdetails(Request $request)
    {
        $dv_data = array();
        $order     = Order::with('OrderItemsmodel.Product')->where('id', $request->orderid)->first();
        $drivers   = Driver::all();
        $driver_order_limit = Configuration::select('decimal_value')->where('name', 'driver_order_limit')->first();

        //add driver object and count of orders in this day (the deliver date of the order) to array
        //do not show the the drivers that exceed the count limit (max no. of orders in one day)
        //validate on assigning order that did not exceeded the max orders in that day
        //then add the driver id to order
        //alert of success or failure
        foreach($drivers as $driver)
        {
            $count = Order::where('driver_id', $driver->id)->where('delivery_date' , $order->delivery_date)->count();

            $data = ['driver'=>$driver , 'count'=>$count];
            array_push($dv_data,$data);
        }

       
        return view('admin.modals.order_details', [
            'order'    => $order,
            'drivers'    => $drivers,
            'dv_data'   =>$dv_data,
            'driver_order_limit'  => $driver_order_limit
        ]);
    }
    
 
}
