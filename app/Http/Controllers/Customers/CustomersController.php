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

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
		$customers         = Customer::orderBy('id','desc')->get();
		
        return view('admin.customers.index', [
            'customers' => $customers,
            'customers_count' => Customer::all()->count(),
        ]);

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

//dd($order['data'][0]);

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
                'auth-token:'.$api_token
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
                    if( $user['msg'] == "Unauthenticated user"){
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
            'auth-token:'.$api_token
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
                    if( $order['msg'] == "Unauthenticated user"){
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
                'auth-token:'.$api_token
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
                    if( $user['msg'] == "Unauthenticated user"){
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
