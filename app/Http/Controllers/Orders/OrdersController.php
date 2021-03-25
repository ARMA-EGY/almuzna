<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
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
		
		$orders          = Order::where('status', 'pending')->orderBy('id','desc')->get();
		
        return view('admin.orders.pending', [
            'orders' => $orders,
            'orders_count' => Order::where('status', 'pending')->count(),
        ]);

    }

    public function accepted()
    {
		
		$orders          = Order::where('status', 'accepted')->orderBy('id','desc')->get();
		
        return view('admin.orders.accepted', [
            'orders' => $orders,
            'orders_count' => Order::where('status', 'accepted')->count(),
        ]);

    }

    public function ontheway()
    {
		
		$orders          = Order::where('status', 'ontheway')->orderBy('id','desc')->get();
		
        return view('admin.orders.ontheway', [
            'orders' => $orders,
            'orders_count' => Order::where('status', 'ontheway')->count(),
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
}
