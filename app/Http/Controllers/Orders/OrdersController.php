<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\OrderItemsmodel;
use App\Driver;
use App\Configuration;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$orders          = Order::orderBy('id','desc')->get();
		
        return view('admin.orders.index', [
            'orders' => $orders,
            'orders_count' => Order::all()->count(),
        ]);

    }

    public function pending()
    {
		
		$orders          = Order::where('status', 'pending')->whereNull('driver_id')->orderBy('id','desc')->get();
		
        return view('admin.orders.pending', [
            'orders' => $orders,
            'orders_count' => Order::where('status', 'pending')->whereNull('driver_id')->count(),
        ]);

    }

    public function accepted()
    {
		
		$orders  = Order::where('status', 'pending')->whereNotNull('driver_id')->orderBy('id','desc')->get();

        return view('admin.orders.accepted', [
            'orders' => $orders,
            'orders_count' => Order::where('status', 'pending')->whereNotNull('driver_id')->count(),
        ]);

    }

    public function ontheway()
    {
		
		$orders          = Order::where('status', 'on the way')->orderBy('id','desc')->get();
		
        return view('admin.orders.ontheway', [
            'orders' => $orders,
            'orders_count' => Order::where('status', 'on the way')->count(),
        ]);

    }

    public function delivered()
    {
		
		$orders          = Order::where('status', 'delivered')->orderBy('id','desc')->get();
		
        return view('admin.orders.delivered', [
            'orders' => $orders,
            'orders_count' => Order::where('status', 'delivered')->count(),
        ]);

    }

    public function cancelled()
    {
		
		$orders          = Order::where('status', 'cancelled')->orderBy('id','desc')->get();
		
        return view('admin.orders.cancelled', [
            'orders' => $orders,
            'orders_count' => Order::where('status', 'cancelled')->count(),
        ]);

    }


    //======== Get Order Details ======== 
    public function getorderdetails(Request $request)
    {
        $dv_data = array();
        $order     = Order::with('OrderItemsmodel.Product')->where('id', $request->orderid)->first();
  
        $lastUserOrder = Order::where('user_id',$order->Customer->id)->whereNotNull('driver_id')->orderBy('created_at', 'desc')->skip(1)->take(1)->get();
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

        if($lastUserOrder->isEmpty())
        {
            return view('admin.modals.order_details', [
                'order'    => $order,
                'drivers'    => $drivers,
                'dv_data'   =>$dv_data,
                'driver_order_limit'  => $driver_order_limit
            ]);
        }else{
            return view('admin.modals.order_details', [
                'order'    => $order,
                'drivers'    => $drivers,
                'lastdriver' => $lastUserOrder[0]->driver_id,
                'dv_data'   =>$dv_data,
                'driver_order_limit'  => $driver_order_limit
            ]);
        }
       

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    //======== Remove Product ======== 
    public function removeproduct(Request $request)
    {
        $item = Product::where('id', $request->id)->first();

        Storage::disk('public')->delete($item->photo);

        $item->delete();
    }


    
    //======== assign order ======== 
    public function assignorder(Request $request)
    {
        $item = Order::where('id', $request->order_id)->first();            
        if(!$item)
        {
            $item->update(['driver_id' => $request->edit_order_status]); 
            if($order->Driver->fcm_token != '')
            {
                if($item->Driver->fcm_lang == 'ar')
                {
                    $notification = array(  
                        'title' => 'طلب',
                        'body'  => 'لديك طلب جديد'
                    );  

                }else{
                    $notification = array(  
                        'title' => 'Order',
                        'body'  => 'You Have One New Order'
                    );              
                }        

                $click = array(  
                    'activity' => 'order',
                    'order_id'  => $item->order_id
                );
                $data = array(  
                    'to' => $item->Driver->fcm_token,
                    'notification'  =>$notification,
                    'data' => $click
                );

                $data_string = json_encode($data);
                $ch = curl_init('https://fcm.googleapis.com/fcm/send');

                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                curl_setopt($ch, CURLOPT_HTTPHEADER, array(          
                    'Content-Type: application/json',
                    'Authorization: key=AAAARku3Lrs:APA91bFdZ6yECIhru1KHjyAV9bBCZ2lnsw5fdb_4AO0497BsN28E6j9htXTbdzRLgV1RoD2h8-UnNXoRet-KVvoXiSAHImQCo2W7gbcUm30muh87pnKH8I03-DupZ_dQLTnMRVIZKQc0'
                )                                                                       
                            );

                $response = curl_exec($ch);
                $err = curl_error($ch);

                curl_close($ch);


                if ($err) {
                    return response()->json([
                        'status' => 'false',
                        'msg' => 'error'
                    ]) ;
                }
            }
            return response()->json([
                'status' => 'true',
                'msg' => 'success'
            ]) ;
        }
        else
        {
            return response()->json([
                'status' => 'false',
                'msg' => 'error'
            ]) ;
        }

    }    
}
