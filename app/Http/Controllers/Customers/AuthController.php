<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $state;
		
        $data = array(  
            'countryCode' => $request->get('countryCode'),
            'phone'  =>$request->get('phone')
                        );

       $data_string = json_encode($data);


        /*
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://armasoftware.com/demo/almuzna_api/api/v1/user/login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "x-api-password: ase1iXcLAxanvXLZcgh6tk",
            ),
        ));
        */


        $ch = curl_init('https://armasoftware.com/demo/almuzna_api/api/v1/user/login');

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(          
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string),
            'x-api-password: ase1iXcLAxanvXLZcgh6tk'
        )                                                                       
                    );                                                                                                                     


        $response = curl_exec($ch);
        $err = curl_error($ch);

        curl_close($ch);


        if ($err)
            return $state = 'failure'; 
     
        $user = json_decode($response, true);

        if(isset($user['message'])){
         if ($user['message'] == 'Unauthenticated.')
            return $state = 'failure';              
        }
        if(!$user['status'])
            return $state = 'failure';

        session([ 'user_id' => $user['data']['id'] ]);
        session([ 'api_token' => $user['data']['api_token'] ]);
        
        return $state = 'success';

    }
    



    
}
