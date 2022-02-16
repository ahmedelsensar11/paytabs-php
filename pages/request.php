<?php
$serverKey = "SMJN2GHDM2-JDB2KMKMN2-NZZHLZ69GD";
$request_fields = filter_input_array(INPUT_POST);

function verifyRequestSignature($serverKey, $request_fields){
    // 'signature' (hexadecimal encoding for hmac of sorted post form fields)
    $requestSignature = $request_fields["signature"];
    unset($request_fields["signature"]);
    // Ignore empty values fields
    $request_fields = array_filter($request_fields);
    // Sort form fields
    ksort($request_fields);
    // Generate URL-encoded query string of Post fields except signature field.
    $query = http_build_query($request_fields);
    $signature = hash_hmac('sha256', $query, $serverKey);
    return hash_equals($signature,$requestSignature); //return bool value
}
function invalidRedirect(){
    /*
     * 
     * do your login
     * 
     * */
    echo 'invalid request'; //for example
}
function validRedirect(){
    /*
     * 
     * do your login
     * 
     * */
    echo 'success request and redirect is genuine'; //for example
}
function handleResponse($serverKey,$request_fields){
    if (verifyRequestSignature($serverKey,$request_fields)){
        // VALID Redirect
        validRedirect();
    }else{
        // INVALID Redirect
        invalidRedirect();
    }
}
//handle the response
handleResponse($serverKey,$request_fields);

/*
 * you can clear the next code
 * */
echo "All is working";
echo '<br/>';
//$input_data = file_get_contents('php://input');
//$encoded_data = json_encode($input_data);
//file_put_contents('inputs.txt',$request_fields);
echo '=========';
echo '<br/>';
var_dump($request_fields);
