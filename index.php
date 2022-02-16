<?php
//you can change values but key unchangeable
$dataArr= [
        "profile_id"=>89380,
        "tran_type"=>"sale",
        "tran_class"=>"ecom",
        "cart_id"=>"150",
        "cart_description"=>"Dummy Order 35925502061445345",
        "cart_currency"=>"EGP",
        "cart_amount"=>46.17,
        "callback"=>"https://qbizns.com/paytabs-php/pages/request.php",
        "return"=>"https://qbizns.com/paytabs-php/pages/request.php",
    ];

$url = "https://secure-egypt.paytabs.com/payment/request ";
$server_key = 'SMJN2GHDM2-JDB2KMKMN2-NZZHLZ69GD';
$data = json_encode($dataArr);

//general fun
function curlPostRequest($url, $data, $server_key)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $headers = array(
        "content-type: application/json",
        "accept: application/json",
        "authorization:" . $server_key,
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
}

//make post request
$result = curlPostRequest($url, $data, $server_key);
$response = json_decode($result, true);

//var_dump($response);
if (isset($response['tran_ref'])){
    //request is valid
    //redirect to complete the payment on pay tabs gateway
    header('Location: ' . $response['redirect_url']);
}else{
    //some error occurs
    var_dump($response);
}