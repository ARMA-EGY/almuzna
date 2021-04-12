<?php

function userProfile($request) {

		$userId = $request->session()->get('user_id');
		$api_token = $request->session()->get('api_token');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://armasoftware.com/demo/almuzna_api/api/v1/user/profile",
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
            abort(500);
            
        } else {
            $user = json_decode($response, true);
            if(isset($user['message'])){
             if ($user['message'] == 'Unauthenticated.')
                abort(500);  
                           
            }
            if(!$user['status']){
            	if( $user['msg'] == "Unauthenticated user"){
            		$request->session()->forget(['user_id', 'api_token']);
            		return redirect(route('welcome'));
            	}
              abort(500);
            	
            }
        }
        return $user['data'];

}




function userOrders($request) {

        $userId = $request->session()->get('user_id');
        $api_token = $request->session()->get('api_token');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://armasoftware.com/demo/almuzna_api/api/v1/user/allorders",
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
            abort(500);
            
        } else {
            $orders = json_decode($response, true);
            if(isset($orders['message'])){
             if ($orders['message'] == 'Unauthenticated.')
                abort(500);  
                           
            }
            if(!$orders['status']){
                if( $orders['msg'] == "Unauthenticated user"){
                    $request->session()->forget(['user_id', 'api_token']);
                    return redirect(route('welcome'));
                }elseif ($orders['msg'] == "no order found") {
                    return 'no orders';
                }
              abort(500);
                
            }
        }
        return $orders['data'];

}




function order($request , $orderId) {

        $userId = $request->session()->get('user_id');
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
            abort(500);
            
        } else {
            $order = json_decode($response, true);
            if(isset($order['message'])){
             if ($order['message'] == 'Unauthenticated.')
                abort(500);  
                           
            }
            if(!$order['status']){
                if( $order['msg'] == "Unauthenticated user"){
                    $request->session()->forget(['user_id', 'api_token']);
                    return redirect(route('welcome'));
                }
              abort(500);
                
            }
        }


        return $order;

}
?>