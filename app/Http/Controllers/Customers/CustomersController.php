<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Social;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Configuration;
use App\OrderItemsmodel;
use App\Http\Requests\locationValid;
use App\customer_location;
use LaravelLocalization;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


public function addlocation(locationValid $request)
{

    if ($request->session()->has('user_id') && $request->session()->has('api_token')){

       
        $customer_location =  customer_location::create([
            'customer_id' =>  $request->session()->get('user_id'),
            'lat' => $request->get('orderlat-modal'),
            'lng' => $request->get('orderlong-modal'),
            'delivery_address' => $request->get('delivery_address-modal'),
            'street' => $request->get('street'),
            'building' => $request->get('building'),
            'floor' => $request->get('floor'),
            'apartment' => $request->get('apartment'),
            'note' => $request->get('inputAddress'),
        ]);        
        return response()->json([
            'status' => 'true',
            'msg' => 'Location is Added Successfully'
        ]) ;
    }

    return response()->json([
        'status' => 'false',
        'msg' => 'Please login'
    ]) ;
}

    public function index()
    {
		
		$customers         = Customer::orderBy('id','desc')->get();
		
        return view('admin.customers.index', [
            'customers' => $customers,
            'customers_count' => Customer::all()->count(),
        ]);

    }

    
    public function reorder($id)
    {
		
		$items         = OrderItemsmodel::where('order_id',$id)->get();
        Cart::destroy();
        foreach($items as $item)
        {
            $cartItem = Cart::add($item->product_id,  $item->Product->name_en , $item->quantity, $item->total, 10 , ['deliveryFee' => 0.00 , 'couponDiscount' => 0.00]);
            Cart::associate($cartItem->rowId, 'App\Product');
        }

        return redirect(route('checkout'));
    }

    public function applyCode(Request $request)
    {


        if ($request->session()->has('user_id') && $request->session()->has('api_token')){

            $api_token = $request->session()->get('api_token');

            $code = $request->get('code');
           
            $ch = curl_init('https://armasoftware.com/demo/almuzna_api/api/v1/coupon/apply/'.$code);

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(          
                'Content-Type: application/json',
                'x-api-password: ase1iXcLAxanvXLZcgh6tk',
                'auth-token:'.$api_token,
                'lang:'.LaravelLocalization::getCurrentLocale()
            )                                                                       
                        );

            $response = curl_exec($ch);
            $err = curl_error($ch);

            curl_close($ch);


            if ($err) {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'Oops Something went wrong'
                ]) ;
            }else {
                $user = json_decode($response, true);

                if(isset($user['message'])){
                 if ($user['message'] == 'Unauthenticated.'){
                    return response()->json([
                        'status' => 'true',
                        'msg' => 'Oops Something went wrong'
                    ]) ;
                 }
                     
                               
                }
                if(!$user['status']){
                    if( $user['msg'] == "Unauthenticated user" || $user['msg'] == "مستخدم غير مصدق"){
                        $request->session()->forget(['user_id', 'api_token']);
                        return response()->json([
                            'status' => 'false'
                                        ]) ;
                    }
                    return response()->json([
                        'status' => 'true',
                        'msg' => $user['msg']
                    ]) ;
                    
                }
              

              if($user['msg'] == "promo code is Applied" || $user['msg'] =="تم تطبيق الرمز الترويجي")
              {
                    if($user['data']['type'] == "percentage")
                    {
                        $subtotal = Cart::subtotal();

                        $sales_perc = Configuration::select('decimal_value')->where('name','sales_tax')->first();
                        $sales_tax = $subtotal * ($sales_perc->decimal_value/100);

                        $totalTax = $subtotal + $sales_tax;

                        $couponDiscount = $totalTax * ($user['data']['discount']/100);

                        foreach(Cart::content() as $item)
                        {

                            $option = $item->options->merge(['couponDiscount' => $couponDiscount , 'deliveryFee' => $item->options->deliveryFee]);
                            $iteme = Cart::update($item->rowId, ['options' => $option]);
                            
                        }                        

                        return response()->json([
                        'status' => 'true',
                        'msg' => $user['msg'],
                        'couponDiscount'=> $couponDiscount
                        ]) ;
                    }else{

                
                        foreach(Cart::content() as $item)
                        {
                            
                            $option = $item->options->merge(['couponDiscount' => $user['data']['discount'] , 'deliveryFee' => $item->options->deliveryFee]);
                            $iteme = Cart::update($item->rowId, ['options' => $option]);
                            
                        }                      

                        return response()->json([
                        'status' => 'true',
                        'msg' => $user['msg'],
                        'couponDiscount'=> $user['data']['discount']
                        ]) ;   

                    }


              }else{
                    return response()->json([
                        'status' => 'true',
                        'msg' => $user['msg']
                    ]) ;
              }


            }

        }else{
            return response()->json([
                'status' => 'false'
                            ]) ;
        }





    }



    public function placeOrder(Request $request)
    {


        if ($request->session()->has('user_id') && $request->session()->has('api_token')){

            $api_token = $request->session()->get('api_token');
            $products = array();

            $deliveryFee;

            foreach(Cart::content() as $item)
            {
                
                array_push($products, ["id"=>$item->model->id,"quantity"=>$item->qty]);
                $deliveryFee = $item->options['deliveryFee'];
            }

            $subtotal = Cart::subtotal();
            $sales_perc = Configuration::select('decimal_value')->where('name','sales_tax')->first();
            $sales_tax = $subtotal * ($sales_perc->decimal_value/100);
            $totalTax = $subtotal + $sales_tax;
            $total = $totalTax + $deliveryFee;


            $data = array( 


                'payment_method' => $request->post('paymentmethod'),
                'delivery_date'  =>$request->post('delivery_date'),
                'delivery_address' => $request->post('delivery_address'),
                'orderlat'  =>$request->post('orderlat'),
                'orderlong' => $request->post('orderlong'),
                'sales_tax'  =>$sales_perc->decimal_value,
                'delivery_fees' => $request->post('shippingFee'),
                'subtotal'  => $subtotal,
                'total'  =>$total


                            );

           $data['products']=$products;

           $data_string = json_encode($data);

           
            $ch = curl_init('https://armasoftware.com/demo/almuzna_api/api/v1/user/order');

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(          
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'x-api-password: ase1iXcLAxanvXLZcgh6tk',
                'auth-token:'.$api_token,
                'lang:'.LaravelLocalization::getCurrentLocale()
            )                                                                       
                        );

            $response = curl_exec($ch);
            $err = curl_error($ch);

            curl_close($ch);


            if ($err) {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'Oops Something went wrong'
                ]) ;
            }else {
                $user = json_decode($response, true);
                if(isset($user['message'])){
                 if ($user['message'] == 'Unauthenticated.'){
                    return response()->json([
                        'status' => 'true',
                        'msg' => 'Oops Something went wrong'
                    ]) ;
                 }
                     
                               
                }
                if(!$user['status']){
                    if( $user['msg'] == "Unauthenticated user" || $user['msg'] == "مستخدم غير مصدق"){
                        $request->session()->forget(['user_id', 'api_token']);
                        return response()->json([
                            'status' => 'false'
                                        ]) ;
                    }
                    return response()->json([
                        'status' => 'true',
                        'msg' => $user['msg']
                    ]) ;
                    
                }
              
                    return response()->json([
                        'status' => 'true',
                        'msg' => $user['msg']
                    ]) ;

            }

        }else{
            return response()->json([
                'status' => 'false'
                            ]) ;
        }





    }


    //======== Checkout Page ======== 
    public function checkout(Request $request)
    {


        if ($request->session()->has('user_id') && $request->session()->has('api_token')) {
            
           $user = userProfile($request);

           $socials  = Social::all();

           $subtotal = Cart::subtotal();

           $sales_perc = Configuration::select('decimal_value')->where('name','sales_tax')->first();
           $sales_tax = $subtotal * ($sales_perc->decimal_value/100);
           $totalTax = $subtotal + $sales_tax;

           $couponDiscount;
           foreach(Cart::content() as $item) {


              $couponDiscount = $item->options['couponDiscount'];
              break;
           }

           $locations = customer_location::where('customer_id' , $request->session()->get('user_id'))->get();

            $data = [
            'page_token'=>'',
            'socials'=>$socials,
            'user'=>$user,
            'totalTax'=>$totalTax,
            'sales_perc'=>$sales_perc->decimal_value,
            'couponDiscount'=>$couponDiscount,
            'locations'=>$locations
            ];
        

             return view('checkout')->with($data);   
        }

        return redirect(route('welcome'));





    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create', [
            
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customers = Customer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'gender' => $request->gender,
        ]);


        session()->flash('success', 'Customer added successfully');
        
        return redirect(route('customers.index'));
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
    public function edit(Customer $customer)
    {
		return view('admin.customers.create', [
            'customer'      => $customer,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {

        $data = $request->only(['name', 'phone', 'email', 'gender']);
        
        $customer->update($data);

        session()->flash('success', 'Customer updated successfully');
        
        return redirect(route('customers.index'));
    }

    //======== Profile Page ======== 
    public function profile(Request $request)
    {
        $socials                      = Social::all();
      

        if ($request->session()->has('user_id') && $request->session()->has('api_token')) {
            
            $user = userProfile($request);
            $orders = userOrders($request);
            if ($orders == 'no orders') {
                $data = [
                    'page_token'=>'',
                    'socials'=>$socials,
                    'user'=>$user,
                ];

                return view('profile')->with($data); 
            }
            $order = order($request, $orders[0]['id']);



            $data = [
            'page_token'=>'',
            'socials'=>$socials,
            'user'=>$user,
            'orders'=>$orders,
            'order'=>$order['data'][0],

            ];

            return view('profile')->with($data); 
        }

        return redirect(route('welcome'));



            
    }

    public function profileUpdate(Request $request)
    {
        if ($request->session()->has('user_id') && $request->session()->has('api_token')){

            $api_token = $request->session()->get('api_token');
            
            $data = array(  
                'name' => $request->post('username'),
                'email'  =>$request->post('email'),
                'dateOfBirth' => $request->post('birthdate'),
                'gender'  =>$request->post('gender')
                            );

           $data_string = json_encode($data);
            $ch = curl_init('https://armasoftware.com/demo/almuzna_api/api/v1/user/profile');

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(          
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'x-api-password: ase1iXcLAxanvXLZcgh6tk',
                'auth-token:'.$api_token,
                'lang:'.LaravelLocalization::getCurrentLocale()
            )                                                                       
                        );

            $response = curl_exec($ch);
            $err = curl_error($ch);

            curl_close($ch);


            if ($err) {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'Oops Something went wrong'
                ]) ;
            }else {
                $user = json_decode($response, true);
                if(isset($user['message'])){
                 if ($user['message'] == 'Unauthenticated.'){
                    return response()->json([
                        'status' => 'true',
                        'msg' => 'Oops Something went wrong'
                    ]) ;
                 }
                     
                               
                }
                if(!$user['status']){
                    if( $user['msg'] == "Unauthenticated user" || $user['msg'] == "مستخدم غير مصدق"){
                        $request->session()->forget(['user_id', 'api_token']);
                        return response()->json([
                            'status' => 'false'
                                        ]) ;
                    }
                    return response()->json([
                        'status' => 'true',
                        'msg' => $user['msg']
                    ]) ;
                    
                }
              
                    return response()->json([
                        'status' => 'true',
                        'msg' => $user['msg']
                    ]) ;

            }

        }else{
            return response()->json([
                'status' => 'false'
                            ]) ;
        }
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



    public function singleOrder(Request $request)
    {
         if ($request->session()->has('user_id') && $request->session()->has('api_token')){

            $orderId = $request->get('order_id');
            $api_token = $request->session()->get('api_token');

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://armasoftware.com/demo/almuzna_api/api/v1/user/order/".$orderId,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(    
            'x-api-password:ase1iXcLAxanvXLZcgh6tk',
            'auth-token:'.$api_token,
            'lang:'.LaravelLocalization::getCurrentLocale()
                                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);


            if ($err) {
                return 'false pop' ;
            }else {
                $order = json_decode($response, true);
                if(isset($order['message'])){
                 if ($order['message'] == 'Unauthenticated.'){
                    return 'false pop' ;
                 }
                     
                               
                }
                if(!$order['status']){
                    if( $order['msg'] == "Unauthenticated user" || $user['msg'] == "مستخدم غير مصدق"){
                        $request->session()->forget(['user_id', 'api_token']);
                        return 'false';
                    }
                    return 'false pop';
                    
                    
                }
              
                return view('customers.includes.singleorder', [
                    'order'    => $order['data'][0]
                ]);

            }

        }else{
            return 'false' ;
        }       
    } 




    public function cancelOrder(Request $request)
    {
        if ($request->session()->has('user_id') && $request->session()->has('api_token')){

            $api_token = $request->session()->get('api_token');
            $data = array(  
                'order_id' => $request->get('order_id'),
                'refund_method'  =>'wallet'
                            );

           $data_string = json_encode($data);
            $ch = curl_init('https://armasoftware.com/demo/almuzna_api/api/v1/user/cancelorder');

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(          
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'x-api-password: ase1iXcLAxanvXLZcgh6tk',
                'auth-token:'.$api_token,
                'lang:'.LaravelLocalization::getCurrentLocale()
            )                                                                       
                        );

            $response = curl_exec($ch);
            $err = curl_error($ch);

            curl_close($ch);


            if ($err) {
                return response()->json([
                    'status' => 'true',
                    'msg' => 'Oops Something went wrong'
                ]) ;
            }else {
                $user = json_decode($response, true);
                if(isset($user['message'])){
                 if ($user['message'] == 'Unauthenticated.'){
                    return response()->json([
                        'status' => 'true',
                        'msg' => 'Oops Something went wrong'
                    ]) ;
                 }
                     
                               
                }
                if(!$user['status']){
                    if( $user['msg'] == "Unauthenticated user" || $user['msg'] == "مستخدم غير مصدق"){
                        $request->session()->forget(['user_id', 'api_token']);
                        return response()->json([
                            'status' => 'false'
                                        ]) ;
                    }
                    return response()->json([
                        'status' => 'true',
                        'msg' => $user['msg']
                    ]) ;
                    
                }
              
                    return response()->json([
                        'status' => 'true',
                        'msg' => $user['msg']
                    ]) ;

            }

        }else{
            return response()->json([
                'status' => 'false'
                            ]) ;
        }
    }

    
}
