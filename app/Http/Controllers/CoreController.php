<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\MessageRequest;
use App\Http\Requests\SubscriberRequest;
use App\Mail\ContactUs;
use Mail; 

use App\ComponentsModel;
use App\ElementsModel;
use App\CardsModel;
use App\CardsElementsModel;
use App\ClientsModel;

use App\Message;
use App\Subscriber;
use App\Visit;
use App\ReceiverEmail;

use App\Page;
use App\Social;
use App\Logo;
use App\Seo;
use App\Product;
use App\Offer;
use App\Coupon;
use App\Contact;
use App\Blog;
use App\Configuration;
use Gloudemans\Shoppingcart\Facades\Cart;
use LaravelLocalization;

class CoreController extends Controller
{


    public function distanceCalculator(Request $request)
    {


        $lat = $request->get('lat');
        $lng = $request->get('lng');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://maps.googleapis.com/maps/api/distancematrix/json?origins=29.9713333,30.9560137&destinations=".$lat.",".$lng."&key=AIzaSyBNno9sBFWOmpTFRXSDu6C2IskdQfo329Q",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
               
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);


        if ($err) {
            abort(500);
        } else {

            $distancematrix = json_decode($response, true);
            $distance = $distancematrix['rows'][0]['elements'][0]['distance']['value'];
            $kilometeres = $distance * 0.001;
            $deliveryFee = $kilometeres * 5;

            foreach(Cart::content() as $item)
            {

                $option = $item->options->merge(['deliveryFee' => $deliveryFee , 'couponDiscount' => $item->options->couponDiscount]);
                Cart::update($item->rowId, ['options' => $option]);
                
            }
            

            
            return $deliveryFee;
        }

    }

    
    public function itemRemove(Request $request)
    {

       $rowId = $request->get('rowId');

       Cart::remove($rowId);
       
       $subtotal = Cart::subtotal();

       $sales_perc = Configuration::select('decimal_value')->where('name','sales_tax')->first();
       $sales_tax = $subtotal * ($sales_perc->decimal_value/100);

       $totalTax = $subtotal + $sales_tax;

       $Data = [
            'subtotal'=>$subtotal,
            'totalTax'=>$totalTax,
            ];

       return response()->json($Data, 200);

    }

    public function updatCart(Request $request)
    {
       $rowId = $request->get('rowId');
       $qty = $request->get('qty');
       Cart::update($rowId, $qty);

       $subtotal = Cart::subtotal();

       $sales_perc = Configuration::select('decimal_value')->where('name','sales_tax')->first();
       $sales_tax = $subtotal * ($sales_perc->decimal_value/100);

       $totalTax = $subtotal + $sales_tax;

       $Data = [
            'subtotal'=>$subtotal,
            'totalTax'=>$totalTax,
            ];

       return response()->json($Data, 200);

    }

    public function addcart(Request $request)
    {
       // Cart::destroy();
       $id = $request->get('id');
       $name = $request->get('name');
       $price = $request->get('price'); 
       $cartItem = Cart::add($id,  $name , 1, $price, 10 , ['deliveryFee' => 0.00 , 'couponDiscount' => 0.00]);
       Cart::associate($cartItem->rowId, 'App\Product');
       return $cartItem;

    }
    //======== Home Page ======== 
    public function index(Request $request)
    {

        $page                         = Page::where('name','Home')->first();
        $seo                          = Seo::where('page_token',$page->token)->first();
        $socials                      = Social::all();
       // $products                     = Product::select('id', 'on_sale', 'sale_price', 'price', 'photo', 'name_'.LaravelLocalization::getCurrentLocale(). ' as name' )->orderBy('id','desc')->limit(4)->get();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://armasoftware.com/demo/almuzna_api/api/v1/product",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-api-password: ase1iXcLAxanvXLZcgh6tk",
                'lang:'.LaravelLocalization::getCurrentLocale()
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);


        if ($err) {
            abort(500);
        } else {
            $products = json_decode($response, true);
            if(isset($products['message'])){
             if ($products['message'] == 'Unauthenticated.')
                abort(500);               
            }
            if(!$products['status'])
                abort(500);
        }
        

        if ($request->session()->has('user_id') && $request->session()->has('api_token')) {
            
            $user = userProfile($request);

            $data = [
            'page_token'=>$page->token,
            'seo'=>$seo,
            'socials'=>$socials,
            'products'=>$products,
            'user'=>$user,
        ];

        }else{

            $data = [
                'page_token'=>$page->token,
                'seo'=>$seo,
                'socials'=>$socials,
                'products'=>$products,
            ];   

        }



        return view('welcome')->with($data);     
    }


    //======== Products Page ======== 
    public function products(Request $request)
    {
        $page                         = Page::where('name','Products')->first();
        $seo                          = Seo::where('page_token',$page->token)->first();
        $socials                      = Social::all();
        //$products                     = Product::select('id', 'on_sale', 'sale_price', 'price', 'photo', 'name_'.LaravelLocalization::getCurrentLocale(). ' as name' )-> get();


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://armasoftware.com/demo/almuzna_api/api/v1/product/wb",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-api-password: ase1iXcLAxanvXLZcgh6tk",
                'lang:'.LaravelLocalization::getCurrentLocale()
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);


        if ($err) {
            abort(500);
        } else {
            $products = json_decode($response, true);
            if(isset($products['message'])){
             if ($products['message'] == 'Unauthenticated.')
                abort(500);               
            }
            if(!$products['status'])
                abort(500);
        }
        

        if ($request->session()->has('user_id') && $request->session()->has('api_token')) {
            
            $user = userProfile($request);

            $data = [
            'page_token'=>$page->token,
            'seo'=>$seo,
            'socials'=>$socials,
            'products'=>$products,
            'user'=>$user,
        ];

        }else{

            $data = [
            'page_token'=>$page->token,
            'seo'=>$seo,
            'socials'=>$socials,
            'products'=>$products,
            ];   

        }


        return view('products')->with($data);     
    }


    //======== Coupons Page ======== 
    public function coupons(Request $request)
    {
        //$coupons                      = Coupon::where('private',0)->get();
        $page                         = Page::where('name','Coupons')->first();
        $seo                          = Seo::where('page_token',$page->token)->first();
        $socials                      = Social::all();
 
        if ($request->session()->has('user_id') && $request->session()->has('api_token')){

                $api_token = $request->session()->get('api_token');
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://armasoftware.com/demo/almuzna_api/api/v1/coupon/",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "x-api-password: ase1iXcLAxanvXLZcgh6tk",
                        'auth-token:'.$api_token,
                        'lang:'.LaravelLocalization::getCurrentLocale()
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);


                if ($err) {
                    abort(500);
                }else{

                        $coupons = json_decode($response, true);
                        if(isset($coupons['message'])){
                         if ($coupons['message'] == 'Unauthenticated.'){
                            abort(500);
                         }             
                        }

                        if(!$coupons['status']){
                            if( $coupons['msg'] == "Unauthenticated user" || $order['msg'] == "مستخدم غير مصدق"){
                                $request->session()->forget(['user_id', 'api_token']);
                                return redirect(route('welcome'));
                            }
                            abort(500);
                            
                        }
                      
                        $user = userProfile($request);

                        $data = [
                        'page_token'=>$page->token,
                        'seo'=>$seo,
                        'socials'=>$socials,
                        'coupons'=>$coupons,
                        'user'=>$user,
                        ];

                     }
        }else{
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://armasoftware.com/demo/almuzna_api/api/v1/coupon/pblc",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "x-api-password: ase1iXcLAxanvXLZcgh6tk",
                        'lang:'.LaravelLocalization::getCurrentLocale()
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);


                if ($err) {
                    abort(500);
                } else {
                    $coupons = json_decode($response, true);
                    if(isset($coupons['message'])){
                     if ($coupons['message'] == 'Unauthenticated.')
                        abort(500);               
                    }
                    if(!$coupons['status'])
                        abort(500);
                }

                $data = [
                'page_token'=>$page->token,
                'seo'=>$seo,
                'socials'=>$socials,
                'coupons'=>$coupons,
                ];
        } 

        return view('coupons')->with($data);    
    }


    //======== Offers Page ======== 
    public function offers(Request $request)
    {
        $page                         = Page::where('name','Offers')->first();
        $seo                          = Seo::where('page_token',$page->token)->first();
        $socials                      = Social::all();
        //$offers                       = Offer::select('id', 'old_price', 'price', 'image', 'name_'.LaravelLocalization::getCurrentLocale(). ' as name' )-> get();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://armasoftware.com/demo/almuzna_api/api/v1/offers/wb",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-api-password: ase1iXcLAxanvXLZcgh6tk",
                'lang:'.LaravelLocalization::getCurrentLocale()
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);


        if ($err) {
            abort(500);
        } else {
            $products = json_decode($response, true);
            if(isset($products['message'])){
             if ($products['message'] == 'Unauthenticated.')
                abort(500);               
            }
            if(!$products['status'])
                abort(500);
        }
        

        if ($request->session()->has('user_id') && $request->session()->has('api_token')) {
            
            $user = userProfile($request);

            $data = [
            'page_token'=>$page->token,
            'seo'=>$seo,
            'socials'=>$socials,
            'products'=>$products,
            'user'=>$user,
        ];

        }else{

            $data = [
            'page_token'=>$page->token,
            'seo'=>$seo,
            'socials'=>$socials,
            'products'=>$products,
            ];   

        }


        return view('offers')->with($data);     
    }


    //======== Contact Page ======== 
    public function contact()
    {
        $page                         = Page::where('name','Contact')->first();
        $seo                          = Seo::where('page_token',$page->token)->first();
        $socials                      = Social::all();
        
        $data = [
            'page_token'=>$page->token,
            'seo'=>$seo,
            'socials'=>$socials,
        ];

        return view('contact')->with($data);     
    }






    //======== Single Blog Page ======== 
    public function singleblog($url)
    {
        $blog           = Blog::where('url', $url)->first();
        
        $relateds       = Blog::whereNotIn('id', [$blog->id])->inRandomOrder()->limit(6)->get();

        // get previous 
        $prev           = Blog::where('id', '<', $blog->id)->orderBy('id','desc')->first();

        // get next 
        $next           = Blog::where('id', '>', $blog->id)->orderBy('id')->first();
        
        $seo            = Seo::where('page_token',$blog->token)->first();
        $socials        = Social::all();
        $logo           = Logo::first();
        $contact        = Contact::first();

        return view('blog_single', [
          'blog' => $blog,
          'relateds' => $relateds,
          'prev' => $prev,
          'next' => $next,
          'page_token'=>$blog->token,
          'seo'=>$seo,
          'socials'=>$socials,
          'logo'=>$logo,
          'contact'=>$contact,
        ]);
    }

    //======== Messages ======== 
    public function message(MessageRequest $request)
    {
        $message1 =  Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        $receiver_email     = ReceiverEmail::first();

        $data = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'subject' => $request->subject,
        'message' => $request->message,
        ];

        Mail::to($receiver_email->email)->send(new ContactUs($data));

        if($message1)
        {
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


    //======== Subscribe ======== 
    public function subscribe(SubscriberRequest $request)
    {
        $subscribe =  Subscriber::create([
            'subscriber_email' => $request->subscriber_email,
        ]);

        if($subscribe)
        {
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

    //======== Get Visit Data ======== 
    public function visits(Request $request)
    {
        $ip                 = $request->ip;
        $page_token         = $request->page_token;
        
        $visit              = Visit::where('page_token', $page_token)->where('ip', $ip)->first();
        $blog               = Blog::where('token', $page_token)->first();


        if($visit)
        {
            $views = $visit->views + 1;

            $visit->views = $views;

            $visit->save();
        }
        else
        {
            $visit = Visit::create([
                'ip' => $ip,
                'page_token' => $page_token,
                'views' => 1,
            ]);
        }

        if($blog)
        {
            $blog->views = $visit->views;

            $blog->save();
        }

    }

}
