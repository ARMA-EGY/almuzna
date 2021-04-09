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

?>